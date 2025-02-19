<?php

namespace App\Actions\Renew\Renew_Motorcycle;
use App\Models\Membership;
use Carbon\Carbon;
use App\Traits\Generate_series;
use App\Traits\Systemencryption;
use Mews\Purifier\Facades\Purifier;

use App\Traits\Validation\Get_user_entries;
use App\Traits\Validation\SecurityValidationTrait;
use Illuminate\Support\Facades\Auth;
class Renew_motorcycle_store
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

        //return dd($request);
        // Additional token validation
        if (!$request->session()->token() === $request->input('_token')) {
            abort(403, 'CSRF token mismatch');
        }
        
        $request_array = $request->personal_info;

        
        $entries = $this->get_user_entries([
            'firstname' => strip_tags(Purifier::clean($request_array['members_firstname'])),
            'lastname' => $this->encrypt(strip_tags(Purifier::clean($request_array['members_lastname'])))
        ]);

        // if ($entries > 3) {
        //     return redirect()->route('kiosk_muliple_entries_error', ['id' => $branch_id, 'name' => $branch_name]);
        //  } 
         $result_record = session('result_record');
         $request_array["record_id"] = $this->secureValidate($result_record['vehicleinfohead_id'],'integer');
         $request_array["record_no"] = $this->secureValidate($result_record['vehicleinfohead_order'],'integer');
        // Convert the birthdate to the correct format

        $members_birthdate = Carbon::createFromFormat('m/d/Y', $request->personal_info['members_birthdate'])->format('Y-m-d');
        $request_array["members_birthdate"] = $this->encrypt($this->secureValidate($members_birthdate));
      
        $request_array["reference_number"]  = $this->secureValidate($request->input('reference_num'));




        // VALIDATION FOR REPRESENTATIVE
        $request_array["representative_name"]      = !is_null($request->input('personal_info.representative_name')) ? $this->encrypt($this->secureValidate($request->input('personal_info.representative_name'))) : null;
        // $request_array["representative_contactno"] = !is_null($request->input('personal_info.representative_contactno')) ? $this->encrypt($this->secureValidate($request->input('personal_info.representative_contactno'))) : null;
        // $request_array["representative_address"]   = !is_null($request->input('personal_info.representative_address')) ? $this->encrypt($this->secureValidate($request->input('personal_info.representative_address'))) : null;

        $user = Auth::user();

        // $request_array["branch"]                     = $branch_id;
        $request_array["typesofapplication"]  = 'RENEW';
        $request_array["platform"]            = 'Agency Platform';
        $request_array["category"]            = 'Agency';
        $request_array["application_date"]    = date("Y-m-d");
        // $request_array["membership_type"]     = 'MOTORCYCLE MEMBERSHIP PLUS';
        // $request_array["plantype_id"]         = $request->input("");
        $request_array['agent']               = $user->id;
        $request_array['option']              = 'Authorized';
        $request_array['representative_name'] = $user->name;
        $request_array["status"]              = "PENDING";

         
        // STEP 2 Beneficiaries
        $request_array["insured1"]      = !is_null($request->input('personal_info.insured1')) ? $this->encrypt($this->secureValidate($request->input('personal_info.insured1'))) : null;
        $request_array["insured2"]      = !is_null($request->input('personal_info.insured2')) ? $this->encrypt($this->secureValidate($request->input('personal_info.insured2'))) : null;
        $request_array["insured3"]      = !is_null($request->input('personal_info.insured3')) ? $this->encrypt($this->secureValidate($request->input('personal_info.insured3'))) : null;

        $request_array["beneficiary1"]      = !is_null($request->input('personal_info.beneficiary1')) ? $this->encrypt($this->secureValidate($request->input('personal_info.beneficiary1'))) : null;
        $request_array["beneficiary2"]      = !is_null($request->input('personal_info.beneficiary2')) ? $this->encrypt($this->secureValidate($request->input('personal_info.beneficiary2'))) : null;
        $request_array["beneficiary3"]      = !is_null($request->input('personal_info.beneficiary3')) ? $this->encrypt($this->secureValidate($request->input('personal_info.beneficiary3'))) : null;

        $request_array["relation1"]      = !is_null($request->input('personal_info.relation1')) ? $this->encrypt($this->secureValidate($request->input('personal_info.relation1'))) : null;
        $request_array["relation2"]      = !is_null($request->input('personal_info.relation2')) ? $this->encrypt($this->secureValidate($request->input('personal_info.relation2'))) : null;
        $request_array["relation3"]      = !is_null($request->input('personal_info.relation3')) ? $this->encrypt($this->secureValidate($request->input('personal_info.relation3'))) : null;

        // $request_array["bday_insured1"]      = !is_null($request->input('personal_info.bday_insured1')) ? $this->encrypt(strip_tags($request->input('personal_info.bday_insured1'))) : null;
        // $request_array["bday_insured2"]      = !is_null($request->input('personal_info.bday_insured2')) ? $this->encrypt(strip_tags($request->input('personal_info.bday_insured2'))) : null;
        // $request_array["bday_insured3"]      = !is_null($request->input('personal_info.bday_insured3')) ? $this->encrypt(strip_tags($request->input('personal_info.bday_insured3'))) : null;

        $request_array["bday_insured1"] = !is_null($request->input('personal_info.bday_insured1'))
            ? $this->encrypt($this->secureValidate(Carbon::createFromFormat('m/d/Y', $request->input('personal_info.bday_insured1'))->format('Y-m-d')))
            :  null;
        $request_array["bday_insured2"] = !is_null($request->input('personal_info.bday_insured2'))
            ? $this->encrypt($this->secureValidate(Carbon::createFromFormat('m/d/Y', $request->input('personal_info.bday_insured2'))->format('Y-m-d')))
            :  null;
        $request_array["bday_insured3"] = !is_null($request->input('personal_info.bday_insured3'))
            ? $this->encrypt($this->secureValidate(Carbon::createFromFormat('m/d/Y', $request->input('personal_info.bday_insured3'))->format('Y-m-d')))
            :  null;

        // $request_array["representative_age"]       = !is_null($request->input('personal_info.representative_age')) ? $this->encrypt(strip_tags($request->input('personal_info.representative_age'))) : null;


      
        
        // STEP 3 INFORMATION SUMMARY
        // $request_array["uradio"] = $request->input('uradio');
        $request_array["members_lastname"]               = $this->encrypt($request->input('personal_info.members_lastname'));
        $request_array["members_title"]                  = !empty($request->input('uptitle')) && $request->input('uradio')          == 1  ?  $this->encrypt($this->secureValidate($request->input('uptitle'))) : NULL;   
        $request_array["citizenship"]                    = !empty($request->input('ctzen_membership')) && $request->input('uradio') == 1  ?  $this->encrypt($this->secureValidate($request->input('ctzen_membership'))) : NULL;
        $request_array["nationality"]                    = !empty($request->input('nationality')) && $request->input('uradio')      == 1  ?  $this->encrypt($this->secureValidate($request->input('nationality'))) : NULL;       
        $request_array["members_birthplace"]             = !empty($request->input('upbirthplace')) && $request->input('uradio')     == 1  ?  $this->encrypt($this->secureValidate($request->input('upbirthplace'))) : NULL;     
        $request_array["members_gender"]                 = !empty($request->input('upgender')) && $request->input('uradio')         == 1  ?  $this->encrypt($this->secureValidate($request->input('upgender'))) : NULL;         
        $request_array["members_civilstatus"]            = !empty($request->input('upstatus')) && $request->input('uradio')         == 1  ?  $this->encrypt($this->secureValidate($request->input('upstatus'))) : NULL;         
        $request_array["occupation_name"]                = !empty($request->input('upoccupation')) && $request->input('uradio')     == 1  ?  $this->encrypt($this->secureValidate($request->input('upoccupation'))) : NULL;      
        
        $request_array["mailing_preference"]             =  !empty($request->input('upaddress')) && $request->input('uradio')      == 1  ?   $this->secureValidate($request->input('upaddress')) : $this->secureValidate($request_array['mailing_preference'],'mailing_preference');
        
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
      

        $request_array['is_aq']   = $this->secureValidate($request->input('aq'));
        // $request_array['agreeDP'] = $this->secureValidate($request->input('agreeDP'));
        // $request_array['agree']   = $this->secureValidate($request->input('agree'));


        // $request_array["v1"] = $this->secureValidate($request->input('v1'));
        // $request_array["v2"] = $this->secureValidate($request->input('v2'));

        // $series = $this->get_series($branch_name, $branch_id);
        // $request_array["reference_number"] = $series[0];
        // $request_array["series"] = $series[1];


        $new_request = array_merge($request_array);
        // dd($new_request);

        $page= Membership::create($new_request);

        $details = [];
       if (!empty($request->vehicle_info)) {
           $vehicle_info = $request->vehicle_info;
           $plate_keys = preg_grep('/^vehicle_plate\d+$/', array_keys($vehicle_info));
           
           foreach ($plate_keys as $plate_key) {
               $key = substr($plate_key, -1);
               $details[] = [
                   'is_cs'        => $this->secureValidate($vehicle_info["v{$key}e"]) ?? null,
                   'plate'        => $this->encrypt($this->secureValidate($vehicle_info["vehicle_plate{$key}"])),
                   'make'         => $this->secureValidate($vehicle_info["vehicle_make{$key}"]) ?? null,
                   'model'        => $this->secureValidate($vehicle_info["vehicle_model{$key}"]) ?? null,
                   'year'         => $this->secureValidate($vehicle_info["vehicle_year{$key}"]) ?? null,
                   'color'        => $this->secureValidate($vehicle_info["vehicle_color{$key}"]) ?? null,
                   'fuel'         => $this->secureValidate($vehicle_info["vehicle_fuel{$key}"]) ?? null,
                   'transmission' => $this->secureValidate($vehicle_info["vehicle_transmission{$key}"]) ?? null,
                   'or_image'     => null,
                   'cr_image'     => null,
                   'is_active' => 1
               ];
           }
       }

      $page->vehicles()->createMany($details);

      return redirect()->route('renew_reseller');
    }

}
