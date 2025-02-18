<?php

namespace App\Actions\Renew\Renew_Membership;

use App\Models\Membership;
use Carbon\Carbon;
use App\Traits\Generate_series;
use App\Traits\Systemencryption;
use App\Traits\Validation\Get_user_entries;
use Mews\Purifier\Facades\Purifier;
use App\Traits\Validation\SecurityValidationTrait;
use Illuminate\Support\Facades\Auth;

class Renew_membership_store
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
        $result_record = session('result_record');
        $request_array = $request->personal_info;
        
        $request_array["record_id"] = $this->secureValidate($result_record['vehicleinfohead_id'],'integer');
        $request_array["record_no"] = $this->secureValidate($result_record['vehicleinfohead_order'],'integer');
        

        // Additional token validation
        if (!$request->session()->token() === $request->input('_token')) {
            abort(403, 'CSRF token mismatch');
        }

        // $entries = $this->get_user_entries([
        //     'firstname' => strip_tags(Purifier::clean($request_array['members_firstname'])),
        //     'lastname' => $this->encrypt(strip_tags(Purifier::clean($request_array['members_lastname'])))
        // ]);

        $user = Auth::user();

        // $request_array["branch"]             = $branch_id;
        $request_array["typesofapplication"]  = 'RENEW';
        $request_array["platform"]            = 'Agency Platform';
        $request_array["category"]            = 'Agency';
        $request_array["application_date"]    = date("Y-m-d");
        $request_array['agent']               = $user->id;
        $request_array['option']              = 'Authorized';
        $request_array['representative_name'] = $user->name;

        if ($request->personal_info['membership_type'] === "REGULAR INDIVIDUAL") {
            $request_array["plantype_id"] = 1;
        }
        if ($request->personal_info['membership_type'] === "ASSOCIATE INDIVIDUAL") {
            $request_array["plantype_id"] = 2;
        }
        if ($request->personal_info['membership_type'] === "MEMBERSHIP LITE") {
            $request_array["plantype_id"] = 4;
        }
        if ($request->personal_info['membership_type'] === "ELITE") {
            $request_array["plantype_id"] = 5;
        }


        $request_array['plan_type'] =$this->secureValidate($request_array['plan_type'],'plan_type');

        // $series                            = $this->get_series($branch_name, $branch_id);
        // $request_array["reference_number"] = $series[0];
        // $request_array["series"]           = $series[1];

        // STEP 1  PERSONAL INFORMATION AND CONTACT INFORMATION

        $request_array["members_title"]      = !empty($request->input('uptitle')) && $request->input('uradio')      == 1  ?  $this->encrypt($this->secureValidate($request->input('uptitle'))) : NULL;
        $request_array['members_firstname']  = $this->secureValidate($request_array['members_firstname']);
        $request_array['members_lastname']   = $this->encrypt($this->secureValidate($request_array['members_lastname']));
        $request_array['members_middlename'] = $this->secureValidate($request_array['members_middlename']);
        $request_array["members_gender"]     = !empty($request->input('upgender')) && $request->input('uradio')     == 1  ?  $this->encrypt($this->secureValidate($request->input('upgender')),'gender')   : NULL;
        // $request_array['members_birthdate']  = !empty($request->personal_info['members_birthdate'] ? Carbon::createFromFormat('m/d/Y', $request->personal_info['members_birthdate'])->format('Y-m-d') : null );
        $request_array["members_birthplace"] = !empty($request->input('upbirthplace')) && $request->input('uradio') == 1  ?  $this->encrypt($this->secureValidate($request->input('upbirthplace')))   : NULL;
        $request_array["occupation_name"]    = !empty($request->input('upoccupation')) && $request->input('uradio') == 1  ?  $this->encrypt($this->secureValidate($request->input('upoccupation')))   : NULL;

        $request_array["members_civilstatus"] = !empty($request->input('upstatus')) && $request->input('uradio')         == 1  ?  $this->encrypt($this->secureValidate($request->input('upstatus')),'members_civilstatus') : NULL;
        $request_array["citizenship"]         = !empty($request->input('ctzen_membership')) && $request->input('uradio') == 1  ?  $this->encrypt($this->secureValidate($request->input('ctzen_membership')))  : NULL;
        $request_array["nationality"]         = !empty($request->input('nationality')) && $request->input('uradio')      == 1  ?  $this->encrypt($this->secureValidate($request->input('nationality')))  : NULL;

        //HOME ADDRESS

        $request_array['mailing_preference']    = $this->secureValidate($request_array['mailing_preference'],'mailing_preference');
        $request_array["members_haddress1"]     = !empty($request->input('street')) && $request->input('uradio')   == 1  ?  $this->encrypt($this->secureValidate($request->input('street'))) : NULL;
        $request_array["members_haddress2"]     = !empty($request->input('town')) && $request->input('uradio')     == 1  ?  $this->secureValidate($request->input('town')): NULL;
        $request_array["members_housecity"]     = !empty($request->input('city')) && $request->input('uradio')     == 1  ?  $this->secureValidate($request->input('city')) : NULL;
        $request_array["members_housedistrict"] = !empty($request->input('province')) && $request->input('uradio') == 1  ?  $this->secureValidate($request->input('province')) : NULL;
        $request_array["members_housezipcode"]  = !empty($request->input('zcode')) && $request->input('uradio')    == 1  ?  $this->secureValidate($request->input('zcode'),'zipcode') : NULL;

        $request_array["members_housephoneno"]           = !empty($request->input('uphousephone')) && $request->input('uradio')  == 1  ?  $this->encrypt($this->secureValidate($request->input('uphousephone'))) : NULL;
        $request_array["members_mobileno"]               = !empty($request->input('upmobileno')) && $request->input('uradio')    == 1  ?  $this->encrypt($this->secureValidate($request->input('upmobileno'))) : NULL;
        $request_array["members_emailaddress"]           = !empty($request->input('upemail')) && $request->input('uradio')       == 1  ?  $this->encrypt($this->secureValidate($request->input('upemail'),'members_emailaddress')) : NULL;
        $request_array["members_alternate_emailaddress"] = !empty($request->input('upaltemail')) && $request->input('uradio')    == 1  ?  $this->encrypt($this->secureValidate($request->input('upaltemail'),'members_emailaddress')) : NULL;
        $request_array["members_alternate_mobileno"]     = !empty($request->input('upaltmobileno')) && $request->input('uradio') == 1  ?   $this->encrypt($this->secureValidate($request->input('upaltmobileno'))) : NULL;

        //OFFICE ADDRESS
        $request_array["members_businessname"]   = !empty($request->input('company')) && $request->input('uradio')         == 1  ?  $this->secureValidate($request->input('company')) : NULL;
        $request_array["members_oaddress1"]      = !empty($request->input('street1')) && $request->input('uradio')         == 1  ?  $this->encrypt($this->secureValidate($request->input('street1'))) : NULL;
        $request_array["members_oaddress2"]      = !empty($request->input('town1')) && $request->input('uradio')           == 1  ?  $this->secureValidate($request->input('town1')): NULL;
        $request_array["members_officecity"]     = !empty($request->input('city1')) && $request->input('uradio')           == 1  ?  $this->secureValidate($request->input('city1')) : NULL;
        $request_array["members_officedistrict"] = !empty($request->input('province1')) && $request->input('uradio')       == 1  ?  $this->secureValidate($request->input('province1')) : NULL;
        $request_array["members_officezipcode"]  = !empty($request->input('zcode1')) && $request->input('uradio')          == 1  ?  $this->secureValidate($request->input('zcode1'),'zipcode') : NULL;
        $request_array["members_alternate_tel"]  = !empty($request->input('upofficephoneno')) && $request->input('uradio') == 1  ?  $this->encrypt($this->secureValidate($request->input('upofficephoneno'))) : NULL;

        $request_array["status"] = "PENDING";
      
        $request_array['uradio']            = $this->secureValidate($request->input('uradio'),'boolean');  
        $request_array['is_aq']            = $this->secureValidate($request->input('aq'),'boolean');  
        // $request_array["v1"]                = !empty($request->input('v1')) && $request->input('uradio') == 1  ?  1 : NULL;
        // $request_array["v2"]                = !empty($request->input('v2')) && $request->input('uradio') == 1  ?  1 : NULL;

        // dd($request->vehicle_info);

        $new_request = !empty($request->vehicle_info)   ?   array_merge($request_array, $request->vehicle_info) :
        array_merge($request_array);
        // dd($new_request);

        $page = Membership::create($new_request);
        
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
            $page->vehicles()->createMany($details);
        }
        // dd($details);


        return redirect()->route('renew_reseller');
    }

}
