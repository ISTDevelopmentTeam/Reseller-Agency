<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RenewMembershipRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
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
  
            "personal_info.option"                   => "nullable|string|in:Personal,Authorized Representative",
            "personal_info.representative_name"      => "nullable|string|max:50",
            "personal_info.representative_contactno" => "nullable|string|max:50",
            "personal_info.representative_address"   => "nullable|string|max:100",
            // "personal_info.representative_age"       => "nullable|integer|max:100|min:1",
            "personal_info.membership_type"          => "nullable|string|in:REGULAR INDIVIDUAL,ASSOCIATE INDIVIDUAL,MEMBERSHIP LITE,ELITE",
            "personal_info.plan_type"                => "nullable|string|in:ANNUAL FEE (REGULAR),THREE YEAR FEE (REGULAR),ANNUAL FEE (ASSOCIATE),THREE YEAR FEE (ASSOCIATE),ANNUAL FEE (ELITE),THREE YEAR FEE (ELITE),ANNUAL FEE (MEMBERSHIP LITE)",

            // "personal_info.reference_number"         => "string",
            "personal_info.members_title"            => "nullable|string|in:MR,MS,MRS,ATTY,DR,ENGR,MR.,MS.,MRS.,ATTY.,DR.,ENGR.",
            "uptitle"                                => "nullable|string|in:MR,MS,MRS,ATTY,DR,ENGR,MR.,MS.,MRS.,ATTY.,DR.,ENGR.",
            "personal_info.members_firstname"        => "nullable|string|max:30",
            "personal_info.members_lastname"         => "nullable|string|max:30",
            "personal_info.members_gender"           => "nullable|string|in:MALE,FEMALE",
            "upgender"                               => "nullable|string|in:MALE,FEMALE",

            "members_birthdate"                      =>"nullable|date",

            "personal_info.members_birthplace"       => "nullable|string|max:30",
            "upbirthplace"                           => "nullable|string|max:30",
            
            "personal_info.occupation_name"          => "nullable|string|max:30",
            "upoccupation"                           => "nullable|string|max:30",

            "personal_info.members_civilstatus"      => "nullable|alpha|string|in:SINGLE,MARRIED,WIDOWED",
            "upstatus"                               => "nullable|alpha|string|in:SINGLE,MARRIED,WIDOWED",

            "personal_info.citizenship"              => "nullable|string|alpha|in:FILIPINO,FOREIGNER",
            "ctzen_membership"                       => "nullable|string|alpha|in:FILIPINO,FOREIGNER",
            
            "personal_info.nationality"              => "nullable|string",
            "nationality"                            => "nullable|string",
           
            "personal_info.mailing_preference"       => "nullable|string|in:HOUSE ADDRESS,OFFICE ADDRESS,HOME,OFFICE",
            "personal_info.members_haddress1"        => "nullable|string|max:100",
            "street"                                 => "nullable|string|max:100",

            "personal_info.members_haddress2"        => "nullable|string|max:100",
            "town"                                   => "nullable|string|max:100",

            "personal_info.members_housecity"        => "nullable|string|max:100",
            "city"                                   => "nullable|string|max:100",

            "personal_info.members_housedistrict"    => "nullable|string|max:100",
            "province"                               => "nullable|string|max:100",
            
            "personal_info.members_housezipcode"     => "nullable|max:4|min:4",
            "zcode"                                  => "nullable|max:4|min:4",
            
            "personal_info.members_mobileno"         => "nullable|string|max:20",
            "personal_info.members_housephoneno"     => "nullable|string|max:20",
            "uphousephone"                           => "nullable|string|max:20",
            
            "personal_info.members_emailaddress"     => "nullable|email|string|max:100",
            "upemail"                                => "nullable|email|string|max:100",

            "personal_info.alt_email"                => "nullable|email|string|max:100",
            "upaltemail"                             => "nullable|email|string|max:100",

            "members_alternate_mobileno"            => "nullable|string|max:100",
            "upaltmobileno"                         => "nullable|string|max:100",

            
            "personal_info.members_businessname"   => "nullable|string|max:100",
            "company"                              => "nullable|string|max:100",

            "street1"                              => "nullable|string|max:100",
            "personal_info.members_oaddress1"      => "nullable|string|max:100",

            
            "town1"                                => "nullable|string|max:100",
            "personal_info.members_oaddress2"      => "nullable|string|max:100",

            
            "city1"                                => "nullable|string|max:100",
            "personal_info.members_officecity"     => "nullable|string|max:100",

            "province1"                            => "nullable|string|max:100",
            "personal_info.members_officedistrict" => "nullable|string|max:100",

            
            "zcode1"  => "nullable|max:4|min:4",
            "personal_info.members_officezipcode"  => "nullable|max:4|min:4",

            "upofficephoneno"                      => "nullable|numeric|max:20",
            "personal_info.tele_num"               => "nullable|numeric|max:20",
  
   
            //VEHICLE
            'is_cs.*' => [
                'required',
                'string',  
                'in:0,1,true,false'
            ],

            'vehicle_plate.*' => [
                'required',
                'string',  
                'max:10',
            ],

            'is_diplomat.*' => [
                'required',
                'string',  
                'in:0,1,true,false'
            ],

            'vehicle_make.*' => [
                'required',
                'string',
                'regex:/^[a-zA-Z0-9\s]+$/',
                'max:50'
            ],

            'vehicle_model.*' => [
                'required',
                'string',
                'regex:/^[a-zA-Z0-9\s]+$/',
            ],

            'vehicle_type.*' => [
                'required',
                'string',
                'regex:/^[a-zA-Z0-9\s]+$/',
            ],

            'vehicle_year.*' => [
                'required',
                'integer',
                'min:1900',
                'max:' . (date('Y'))
            ],

            'submodel.*' => [
                'string',
            ],

            'vehicle_color.*' => [
                'required',
                'string',
            ],

            'vehicle_fuel.*' => [
                'required',
                'string',
                'in:GAS,DIESEL,ELECTRIC',
            ],

            'vehicle_transmission.*' => [
                'required',
                'string',
                'in:AUTOMATIC,MANUAL',
            ],

            // 'no_of_pass.*' => [
            //     'integer',
            //     'min:1',
            //     'max:15'
            // ],

            // 'acts_of_nature.*' => [
            //     'required',
            //     'string',  
            //     'in:YES,NO'
            // ],

            // 'mortgaged.*' => [
            //     'required',
            //     'string',  
            //     'in:YES,NO'
            // ],

            // 'bank.*' => [
            //     'nullable', 
            //     'integer',
            //     'min:1',
            //     'max:25'
            // ],

            // 'amount.*' => [
            //     'nullable', 
            //     'numeric',
            //     'between:0,9999999.99',
            // ],

            'is_vehicle_updated.*' => [
                'required',
                'string',  
                'in:0,1,true,false'
            ],

            'is_vehicle_removed.*' => [
                'required',
                'string',  
                'in:0,1,true,false'
            ],


            // "insurance_quotation"                   => "nullable|int|in:1,0",
            // "isquotation"                           => "nullable|int|in:1,0",
            // "aq"                                    => "nullable|int|in:1,0",
            // "agree"                                 => "nullable|int|in:1,0",

        ];
    }
}
