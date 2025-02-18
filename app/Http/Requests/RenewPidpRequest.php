<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RenewPidpRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
                '_token' => [
                    'required',         
                    'string',              
                    'size:40',           
                    'alpha_num'  
                ],
      
                // STEP 1 License Details
    
                "license_info.members_licenseno"             => "nullable|string|alpha_dash",
                "license_info.members_licenseexpirationdate" => "required|string|date_format:m/d/Y",
                "license_info.members_licensecard"           => "nullable|string|in:CARD,NON-CARD",
                "license_info.members_licensetype"           => "nullable|string|in:PROFESSIONAL,NON PROFESSIONAL",
                'dlcodearray' => [
                    'nullable', 
                    'string', 
                    'json', 
                    function ($attribute, $value, $fail) {
                        $decoded = json_decode($value, true);
                        if (!is_array($decoded)) {
                            $fail('The dlcode must be a valid .');
                        }
                    }
                ],
                'restric' => [
                    'nullable',
                    'string',
                    'regex:/^(\d+,\s*)*\d+$/',
                    function ($attribute, $value, $fail) {
                        $numbers = array_map('trim', explode(',', $value));
                        
                        // Optional: Ensure no duplicate numbers
                        if (count($numbers) !== count(array_unique($numbers))) {
                            $fail('Duplicate numbers are not allowed.');
                        }
                        
                        // Optional: Validate specific range (e.g., 1-8)
                        foreach ($numbers as $number) {
                            if (!is_numeric($number) || $number < 1 || $number > 8) {
                                $fail('All numbers must be between 1 and 8.');
                            }
                        }
                    }
                ],
                "selection"           => "required|in:restriction,dlcode",
                'members_licensedlcode' => [
                    'nullable',
                    'string',
                    function ($attribute, $value, $fail) {
                        // Attempt to unserialize the value
                        $unserialized = @unserialize($value);
                        
                        // Check if unserialization was successful
                        if ($unserialized === false) {
                            $fail('The '.$attribute.' must be a valid serialized array.');
                            return;
                        }
                        
                        // Ensure it's an array
                        if (!is_array($unserialized)) {
                            $fail('The '.$attribute.' must be an array after unserialization.');
                            return;
                        }
                        
                        // Validate array contents (example checks)
                        foreach ($unserialized as $item) {
                            // Ensure each item is a string
                            if (!is_string($item)) {
                                $fail('Each item in '.$attribute.' must be a string.');
                                return;
                            }
                            
                            // Optional: Additional specific validations
                            // For example, if these should be numeric strings
                            if (!ctype_digit($item)) {
                                $fail('Each item in '.$attribute.' must be a numeric string.');
                                return;
                            }
                        }
          
                    }
                ],
               
                'restriction.*'                                 => 'numeric',
                "restriction"                                   => "array",
                "license_details.members_licenserest"           => "nullable|string",
    
    
                // STEP 2 Personal Info
                "personal_info.plan_type"   => "nullable|in:3,14,16",
                "option1"   => "nullable|in:no,yes",
    
                "option2" => "nullable|in:no,yes",
    
                "destinationIn"   => "nullable|exists:aap_destination,ad_name",
                "destinationOut"   => "nullable|exists:aap_destination,ad_name",
                
                // "destinationIn" => "nullable|regex:/^[a-zA-Z]+\s*[a-zA-Z\.]+$/",
                // "destinationOut" => "nullable|regex:/^[a-zA-Z]+\s*[a-zA-Z\.]+$/",
              
                "purposetravel"   => "nullable|in:Tourism,Work",
                "departure_date"   => "nullable|date_format:m/d/Y",
                "return_date"   => "nullable|date_format:m/d/Y",
    
                "personal_info.members_destination"   => "string",
                "personal_info.members_purposetravel" => "string|alpha",
                "personal_info.is_ofw"                => "nullable|string|alpha",
    
                "personal_info.members_title"            => "nullable|string|in:MR,MS,MRS,ATTY,DR,ENGR,MR.,MS.,MRS.,ATTY.,DR.,ENGR.",
                "uptitle"                                => "nullable|string|in:MR,MS,MRS,ATTY,DR,ENGR,MR.,MS.,MRS.,ATTY.,DR.,ENGR.",
                "personal_info.members_firstname"        => "nullable|string|max:30",
                "personal_info.members_lastname"         => "nullable|string|max:30",
    
                "personal_info.members_birthplace"       => "nullable|string|max:30",
    
                "personal_info.members_gender"           => "nullable|string|in:MALE,FEMALE",
                "personal_info.occupation_name"          => "nullable|string|max:30",
                "personal_info.members_civilstatus"      => "nullable|alpha|string|in:SINGLE,MARRIED,WIDOWED",
                "personal_info.citizenship"              => "nullable|string|alpha|in:filipino,foreigner,FILIPINO,FOREIGNER",
                "personal_info.nationality"              => "nullable|string",
               
               
      
                // STEP 3 Contact Information
                "personal_info.mailing_preference"      => "nullable|string|in:HOUSE ADDRESS,OFFICE ADDRESS,HOME,OFFICE",
    
                "personal_info.members_haddress1"        => "nullable|string|max:100",
                "personal_info.members_haddress2"        => "nullable|string|max:100",
                "personal_info.members_housecity"        => "nullable|string|max:100",
                "personal_info.members_housedistrict"    => "nullable|string|max:100",
                "personal_info.members_housezipcode"     => "nullable|max:4|min:1",
                "personal_info.members_mobileno"         => "nullable|string|max:30",
                "personal_info.members_housephoneno"     => "nullable|string|max:30",
                "personal_info.members_emailaddress"     => "nullable|email|string|max:100",
                "personal_info.alt_email"                => "nullable|email|string|max:100",
    
                "personal_info.members_oaddress1"      => "nullable|string|max:100",
                "personal_info.members_oaddress2"      => "nullable|string|max:100",
                "personal_info.members_officecity"     => "nullable|string|max:100",
                "personal_info.members_officedistrict" => "nullable|string|max:100",
                "personal_info.members_officezipcode"  => "nullable|max:4|min:1",
                "personal_info.members_businessname"   => "nullable|string|max:100",
                "personal_info.tele_num"               => "nullable|numeric|max:20",
                
    
                
                //VEHICLE
                "with_vehicle"                          => "nullable|in:yes,no",
                
                'is_cs.*' => [
                    'nullable',
                    'string',  
                    'in:0,1,true,false'
                ],
    
                'vehicle_plate.*' => [
                    'nullable',
                    'string',  
                    'max:10',
                ],
    
                'is_diplomat.*' => [
                    'nullable',
                    'string',  
                    'in:0,1,true,false'
                ],
    
                'vehicle_make.*' => [
                    'nullable',
                    'string',
                    'regex:/^[a-zA-Z0-9\s]+$/',
                    'max:50'
                ],
    
                'vehicle_model.*' => [
                    'nullable',
                    'string',
                    'regex:/^[a-zA-Z0-9\s]+$/',
                ],
    
                'vehicle_type.*' => [
                    'nullable',
                    'string',
                    'regex:/^[a-zA-Z0-9\s]+$/',
                ],
    
                'vehicle_year.*' => [
                    'nullable',
                    'integer',
                    'min:1900',
                    'max:' . (date('Y'))
                ],
    
                'submodel.*' => [
                    'nullable',
                    'string',
                ],
    
                'vehicle_color.*' => [
                    'nullable',
                    'string',
                ],
    
                'vehicle_fuel.*' => [
                    'nullable',
                    'string',
                    'in:GAS,DIESEL,ELECTRIC',
                ],
    
                'vehicle_transmission.*' => [
                    'nullable',
                    'string',
                    'in:AUTOMATIC,MANUAL',
                ],

                "aq"                                    => "nullable|int|in:1,0",
        ];
    }
}
