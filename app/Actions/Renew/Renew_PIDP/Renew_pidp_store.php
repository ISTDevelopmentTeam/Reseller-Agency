<?php

namespace App\Actions\Renew\Renew_PIDP;

use App\Models\Membership;
use Carbon\Carbon;
use App\Models\PlanType;
use App\Traits\Generate_series;
use App\Traits\Systemencryption;
use Mews\Purifier\Facades\Purifier;
use App\Traits\Insurance\Get_resultcriteria;
use App\Traits\Validation\Get_user_entries;
use App\Traits\Validation\SecurityValidationTrait;
use Illuminate\Support\Facades\Auth;
class Renew_pidp_store
{
    use Generate_series,Get_user_entries,SecurityValidationTrait;

    private $encryption_key;
    private $encryption_iv;
    public function __construct()
    {

        $this->encryption_key = base64_decode(env('ENCRYPTION_KEY'));
        $this->encryption_iv = base64_decode(env('ENCRYPTION_IV'));
    }

    
    public function encrypt($data) {
        $encrypted = openssl_encrypt($data, 'AES-256-CBC',$this->encryption_key  , OPENSSL_RAW_DATA, $this->encryption_iv);
        return base64_encode($encrypted);
    }

    public function decrypt($data) {
        $decrypted = openssl_decrypt(base64_decode($data), 'AES-256-CBC',$this->encryption_key  , OPENSSL_RAW_DATA, $this->encryption_iv);
        return $decrypted;
    }
    
    public function handle($request)
    {

        // Additional token validation
        if (!$request->session()->token() === $request->input('_token')) {
            abort(403, 'CSRF token mismatch');
        }
     
        $request_array = $request->personal_info;

        $entries = $this->get_user_entries([
            'firstname' => strip_tags(Purifier::clean($request_array['members_firstname'])),
            'lastname' => $this->encrypt(strip_tags(Purifier::clean($request_array['members_lastname'])))
        ]);


        // if ($entries > 5) {
        //    return redirect()->route('kiosk_muliple_entries_error', ['id' => $branch_id, 'name' => $branch_name]);
        // } 


        if (!empty($request->input('departure_date1')) && !empty($request->input('return_date1'))) {
            if (!empty($request->input('departure_date1'))) {
                $request_array['departure_date'] = Carbon::parse($request->input('departure_date1'))->format('Y-m-d');
            }
            if (!empty($request->input('return_date1'))) {
                $request_array['arrival_date'] = Carbon::parse($request->input('return_date1'))->format('Y-m-d');
            }
        } else {
            if (!empty($request->input('departure_date'))) {
                $request_array['departure_date'] = Carbon::parse($request->input('departure_date'))->format('Y-m-d');
            }
            if (!empty($request->input('return_date'))) {
                $request_array['arrival_date'] = Carbon::parse($request->input('return_date'))->format('Y-m-d');
            }
        }

        $result_record = session('result_record');
        $request_array["record_id"] = $this->secureValidate($result_record['vehicleinfohead_id'],'integer');
        $request_array["record_no"] = $this->secureValidate($result_record['vehicleinfohead_order'],'integer');
        
        // Convert the birthdate to the correct format
        $members_birthdate = Carbon::createFromFormat('m/d/Y', $request->personal_info['members_birthdate'])->format('Y-m-d');
        $request_array["members_birthdate"] = $this->encrypt($members_birthdate);

        $license_info['members_licenseno']             = $this->encrypt($this->secureValidate($request->input('license_info.members_licenseno')));
        $license_info['members_licensecard']           = $this->secureValidate($request->input('license_info.members_licensecard'));
        $license_info['members_licensetype']           = $this->secureValidate($request->input('license_info.members_licensetype'));

        $lincenexpirationdate = $request->input('license_info.members_licenseexpirationdate');
        $license_expirationdate = Carbon::createFromFormat('m/d/Y', $request->license_info['members_licenseexpirationdate'])->format('Y-m-d');
        $license_info["members_licenseexpirationdate"] = $this->encrypt($this->secureValidate($license_expirationdate));
      

        // THIS FOR LICENSE EXPIRATION WHEN THE VALUE IS 00/00/0000
        if ($lincenexpirationdate == '00/00/0000') {
            $formatteddate = Carbon::createFromFormat('d/m/Y', $lincenexpirationdate)->format("Y/m/d");
            $clear = str_replace('-', '', $formatteddate);
            $format = str_replace('/', '-', $clear);
            $license_info["members_licenseexpirationdate"] = $this->encrypt($this->secureValidate($format));
            // $formatted_date = Carbon::createFromFormat('d/m/Y', $lincenexpirationdate)->format("Y-m-d");
        }


        $request_array["representative_name"]      = !empty($request->input('personal_info.representative_name')) ? $this->encrypt($this->secureValidate($request->input('personal_info.representative_name'))) : null;
        // $request_array["representative_contactno"] = !empty($request->input('personal_info.representative_contactno')) ? $this->encrypt($this->secureValidate($request->input('personal_info.representative_contactno'))) : null;
        // $request_array["representative_address"]   = !empty($request->input('personal_info.representative_address')) ? $this->encrypt($this->secureValidate($request->input('personal_info.representative_address'))) : null;
        // $request_array["representative_age"]       = !is_null($request->input('personal_info.representative_age')) ? $this->encrypt(strip_tags($request->input('personal_info.representative_age'))) : null;

        $no_japan       = $this->secureValidate($request->input('destinationOut'));
        $yes_japan      = $this->secureValidate($request->input('japan_only'));
        $japan_other    = $this->secureValidate($request->input('destinationIn'));
        $purpose_travel = $this->secureValidate($request->input('purposetravel'));
        $is_ofw         = $this->secureValidate($request->input('ofw'));


        if ($no_japan && $purpose_travel != '') {
            $request_array['members_destination']   = $no_japan;
            $request_array['members_purposetravel'] = $purpose_travel;

            if ($request->has('hereby3')) {
                $checkboxValue1              = $request->input('hereby3');
                $request_array['agreeothrs'] = $checkboxValue1;
            }
        } else if ($japan_other && $purpose_travel != '') {
            $request_array['members_destination2']  = $yes_japan;
            $request_array['members_purposetravel'] = $purpose_travel;
            $request_array['members_destination']   = $japan_other;

            if ($request->has('hereby2')) {
                $checkboxValue2             = $request->input('hereby2');
                $request_array['agreejpn2'] = $checkboxValue2;
            }
        } else {
            $request_array['members_destination2']  = $yes_japan;
            $request_array['members_purposetravel'] = $purpose_travel;

            if ($request->has('hereby1')) {
                $checkboxValue3             = $request->input('hereby1');
                $request_array['agreejpn1'] = $checkboxValue3;
            }
        }
        if (!empty($is_ofw)) {
            $request_array['is_ofw'] = $is_ofw;
        }


        $request_array["status"] = "PENDING";
        $request_array["uradio"] = $this->secureValidate($request->input('uradio'));

        // $request_array["v1"]     = !empty($request->input('v1')) ?  $this->secureValidate($request->input('v1')) : NULL;
        // $request_array["v2"]     = !empty($request->input('v2')) ?  $this->secureValidate($request->input('v2')) : NULL;
          // $request_array["nationality"]       = $request->input('nationality');
        $request_array["members_lastname"]  = $this->encrypt($this->secureValidate($request->input('personal_info.members_lastname')));

        $request_array["members_title"]                  = !empty($request->input('uptitle')) && $request->input('uradio')          == 1  ?  $this->encrypt($this->secureValidate($request->input('uptitle'))) : NULL; 
        $request_array["citizenship"]                    = !empty($request->input('ctzen_membership')) && $request->input('uradio') == 1  ?  $this->encrypt($this->secureValidate($request->input('ctzen_membership'))) : NULL;
        $request_array["nationality"]                    = !empty($request->input('nationality')) && $request->input('uradio')      == 1  ?  $this->encrypt($this->secureValidate($request->input('nationality'))) : NULL;       
        $request_array["members_birthplace"]             = !empty($request->input('upbirthplace')) && $request->input('uradio')     == 1  ?  $this->encrypt($this->secureValidate($request->input('upbirthplace'))) : NULL;     
        $request_array["members_gender"]                 = !empty($request->input('upgender')) && $request->input('uradio')         == 1  ?  $this->encrypt($this->secureValidate($request->input('upgender'))) : NULL;          
        $request_array["members_civilstatus"]            = !empty($request->input('upstatus')) && $request->input('uradio')         == 1  ?  $this->encrypt($this->secureValidate($request->input('upstatus'))) : NULL;          
        $request_array["occupation_name"]                = !empty($request->input('upoccupation')) && $request->input('uradio')     == 1  ?  $this->encrypt($this->secureValidate($request->input('upoccupation'))) : NULL;      
        $request_array["members_haddress1"]              = !empty($request->input('street')) && $request->input('uradio')           == 1  ?  $this->encrypt($this->secureValidate($request->input('street'))) : NULL;            
        $request_array["members_haddress2"]              = !empty($request->input('town')) && $request->input('uradio')             == 1  ?  $this->secureValidate($request->input('town')) : NULL;                              
        $request_array["members_housecity"]              = !empty($request->input('city')) && $request->input('uradio')             == 1  ?  $this->secureValidate($request->input('city')) : NULL;                             
        $request_array["members_housedistrict"]          = !empty($request->input('province')) && $request->input('uradio')         == 1  ?  $this->secureValidate($request->input('province')) : NULL;                          
        $request_array["members_housezipcode"]           = !empty($request->input('zcode')) && $request->input('uradio')            == 1  ?  $this->secureValidate($request->input('zcode')) : NULL;                             
        $request_array["members_businessname"]           = !empty($request->input('company')) && $request->input('uradio')          == 1  ?  $this->secureValidate($request->input('company')) : NULL;                          
        $request_array["members_oaddress1"]              = !empty($request->input('street1')) && $request->input('uradio')          == 1  ?  $this->encrypt($this->secureValidate($request->input('street1'))) : NULL;          
        $request_array["members_oaddress2"]              = !empty($request->input('town1')) && $request->input('uradio')            == 1  ?  $this->secureValidate($request->input('town1')) : NULL;                             
        $request_array["members_officecity"]             = !empty($request->input('city1')) && $request->input('uradio')            == 1  ?  $this->secureValidate($request->input('city1')) : NULL;                             
        $request_array["members_officedistrict"]         = !empty($request->input('province1')) && $request->input('uradio')        == 1  ?  $this->secureValidate($request->input('province1')) : NULL;                        
        $request_array["members_officezipcode"]          = !empty($request->input('zcode1')) && $request->input('uradio')           == 1  ?  $this->secureValidate($request->input('zcode1')) : NULL;                           
        $request_array["members_housephoneno"]           = !empty($request->input('uphousephone')) && $request->input('uradio')     == 1  ?  $this->encrypt($this->secureValidate($request->input('uphousephone'))) : NULL;      
        $request_array["members_mobileno"]               = !empty($request->input('upmobileno')) && $request->input('uradio')       == 1  ?  $this->encrypt($this->secureValidate($request->input('upmobileno'))) : NULL;        
        $request_array["members_alternate_tel"]          = !empty($request->input('upofficephoneno')) && $request->input('uradio')  == 1  ?  $this->encrypt($this->secureValidate($request->input('upofficephoneno'))) : NULL;
        $request_array["members_emailaddress"]           = !empty($request->input('upemail')) && $request->input('uradio')          == 1  ?  $this->encrypt($this->secureValidate($request->input('upemail'))) : NULL;           
        $request_array["members_alternate_emailaddress"] = !empty($request->input('upaltemail')) && $request->input('uradio')       == 1  ?  $this->encrypt($this->secureValidate($request->input('upaltemail'))) : NULL;        
        $request_array["members_alternate_mobileno"]     = !empty($request->input('upaltmobileno')) && $request->input('uradio')    == 1  ?  $this->encrypt($this->secureValidate($request->input('upaltmobileno'))) : NULL;    


        $request_array["mailing_preference"]  =  $this->secureValidate($request->input('personal_info.mailing_preference'));
        $request_array['is_aq']   = $this->secureValidate($request->input('aq'));
        // $request_array['agreeDP'] = $request->input('agreeDP');
        // $request_array['agree']   = $this->secureValidate($request->input('agree'));

        $user = Auth::user();

        // $request_array["branch"]             = $branch_id;
        $request_array["typesofapplication"] = 'RENEW';
        $request_array["platform"]           = 'Agency Platform';
        $request_array["category"]           = 'Agency';
        $request_array["application_date"]   = date("Y-m-d");
        $request_array['agent']               = $user->id;
        $request_array['option']              = 'Authorized';
        $request_array['representative_name'] = $user->name;


        $request_array["membership_type"] = 'PIDP';
        
        // Get the selected plan type ID from the request
        $selected_plan_id = $this->secureValidate($request->input('personal_info.plan_type'));
        
        // Get the plan details from database
        $plan = PlanType::where('plan_id', $selected_plan_id)
            ->where('membership_id', 3) // PIDP membership
            ->first();
            
        if ($plan) {
            $request_array["plantype_id"] = $plan->plan_id;
            
            // Get the corresponding regular plan dynamically
            $regularPlan = $this->getRegularPlan($plan->plan_name);
            
            $request_array["plan_type"] = $regularPlan;
            $request_array["pidp_plantype"] = $plan->plan_name;
        }

        // DL CODE
        $dlcode = $this->secureValidate($request->input('dlcodearray'));
                
        if(empty($dlcode)){
            $request_array["members_licensedlcode"] = null;
            $request_array["is_dlcode"] = 1;
        }else{
            $restriction_array                      = explode(',', $dlcode);
            $restriction_array                      = array_map('trim', $restriction_array);
            $indexed_array                          = array_combine(range(1, count($restriction_array)), array_values($restriction_array));
            $restric_sr                             = serialize($indexed_array);
            $request_array["is_dlcode"]             = 2;
            $request_array["members_licensedlcode"] = $restric_sr;
        }

        // RESTRICTION
        $restriction = $this->secureValidate($request->input('restriction'));

        if(empty($restriction)){
            $request_array["members_licenserest"] = null;
        }else{
        $restriction = array_combine(range(1, count($restriction)), array_values($restriction));
        $sr = serialize($restriction);
        // $array["members_licenserest"] = implode(',', array_values(unserialize($sr)));
        $request_array["members_licenserest"] = $sr;
        }


        // $series = $this->get_series($branch_name, $branch_id);
        // $request_array["reference_number"] = $series[0];
        // $request_array["series"] = $series[1];


        $new_request = array_merge($request_array, $license_info);
        // dd($new_request);

       $Membership= Membership::create($new_request);

       if (isset($request->vehicle_plate) && is_array($request->vehicle_plate)) {
            foreach ($request->input('vehicle_plate') as $key => $value) {
                $details[] = [
                    'is_cs'          => isset($request->is_cs[$key]) ? ($this->secureValidate($request->input('is_cs')[$key]) === '1' ? '1' : '0') : '0',
                    'plate'          => isset($request->vehicle_plate[$key]) ? $this->encrypt($this->secureValidate($request->input('vehicle_plate')[$key])) : null,
                    'make'           => isset($request->vehicle_make[$key]) ? $this->secureValidate($request->input('vehicle_make')[$key]) : null,
                    'model'          => isset($request->vehicle_model[$key]) ? $this->secureValidate($request->input('vehicle_model')[$key]) : null,
                    'year'           => isset($request->vehicle_year[$key]) ? $this->secureValidate($request->input('vehicle_year')[$key],'year') : null,
                    'color'          => isset($request->vehicle_color[$key]) ? $this->secureValidate($request->input('vehicle_color')[$key]) : null,
                    'fuel'           => isset($request->vehicle_fuel[$key]) ? $this->secureValidate($request->input('vehicle_fuel')[$key],'vehicle_fuel') : null,
                    'transmission'   => isset($request->vehicle_transmission[$key]) ? $this->secureValidate($request->input('vehicle_transmission')[$key]) : null,
                    'or_image'       => $request->hasFile("or_image.{$key}") ?
                        $this->encrypt($request->file("or_image.{$key}")->storeAs(
                            'img',
                            'or_' . uniqid() . '.' . $request->file("or_image.{$key}")->getClientOriginalExtension(),
                            'public'
                        )) : null,
                    'cr_image'       => $request->hasFile("cr_image.{$key}") ?
                        $this->encrypt($request->file("cr_image.{$key}")->storeAs(
                            'img',
                            'cr_' . uniqid() . '.' . $request->file("cr_image.{$key}")->getClientOriginalExtension(),
                            'public'
                        )) : null,
                    'vehicle_type'   => isset($request->vehicle_type[$key]) ? $this->secureValidate($request->input('vehicle_type')[$key]) : null,
                    'submodel'       => isset($request->submodel[$key]) ? $this->secureValidate($request->input('submodel')[$key]) : null,
                    'is_active'      => 1,
                    'is_diplomat'    => isset($request->is_diplomat[$key]) ? ($this->secureValidate($request->input('is_diplomat')[$key]) === '1' ? '1' : '0') : '0',
                    'is_vehicle_updated' => isset($request->is_vehicle_updated[$key]) ? ($this->secureValidate($request->input('is_vehicle_updated')[$key]) === '1' ? '1' : '0') : '0',
                    'is_vehicle_removed' => isset($request->is_vehicle_removed[$key]) ? ($this->secureValidate($request->input('is_vehicle_removed')[$key]) === '1' ? '1' : '0') : '0',
                ];
            }
            $Membership->vehicles()->createMany($details);
        }

        return redirect()->route('renew_reseller');
    }

    protected function getRegularPlan($pidpPlanName)
    {
        // Extract the duration pattern from PIDP plan name (e.g., "ANNUAL", "TWO YEARS", "THREE YEARS")
        preg_match('/(ANNUAL|[\w\s]+YEAR[S]*)/', $pidpPlanName, $matches);
        $duration = $matches[0] ?? '';
        
        // Query the regular plan based on the duration pattern
        $regularPlan = PlanType::where('plan_name', 'LIKE', "%{$duration}%")
            ->where('plan_name', 'LIKE', '%(REGULAR)%')
            ->where('membership_id', 1) // Regular membership ID
            ->first();
            
        return $regularPlan ? $regularPlan->plan_name : $pidpPlanName;
    }
}
