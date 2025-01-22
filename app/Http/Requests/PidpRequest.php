<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PidpRequest extends FormRequest
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

            // PERSONAL INFORMATION
            "personal_info.membership_type"     => "required|string",
            "personal_info.plantype_id"             => "required|string",
            "personal_info.members_title"       => "required|alpha|string|in:MR,MS,MRS,ATTY,DR,ENGR",
            "personal_info.members_firstname"   => "required|string|max:30",
            "personal_info.members_lastname"    => "required|string|max:30",
            "personal_info.members_gender"      => "required|alpha|string||in:MALE,FEMALE",
            "personal_info.members_birthplace"  => "required|string|max:30",
            "personal_info.occupation_name"     => "required|string||max:30",
            "personal_info.members_birthdate"   => "required|date",
            "personal_info.members_civilstatus" => "required|alpha|string|in:SINGLE,MARRIED,WIDOWED",
            "personal_info.citizenship"         => "required|string|alpha|in:filipino,foreigner",
            "personal_info.nationality"         => "nullable|string",

            'idpicture' => [
                'required',
                'image',
                'mimes:jpeg,png,bmp,gif,svg,webp',
                'max:1024', // 1MB
                // 'dimensions:min_width=100,min_height=200',
            ],

            // CONTACT INFORMATION
            "personal_info.mailing_preference"             => "nullable|string|in:HOUSE ADDRESS,OFFICE ADDRESS",
            "personal_info.members_haddress1"              => "required|string|max:100",
            "personal_info.members_haddress2"              => "required|string|max:100",
            "personal_info.members_housecity"              => "required|string|max:100",
            "personal_info.members_housedistrict"          => "required|string|max:100",
            "personal_info.members_housezipcode"           => "required|max:4|min:4",
            "personal_info.members_mobileno"               => "nullable|string|max:20",
            "personal_info.members_alternate_mobileno"     => "nullable|string|max:20",
            "personal_info.members_emailaddress"           => "nullable|email|string|max:100",
            "personal_info.members_alternate_emailaddress" => "nullable|email|string|max:100",

            "personal_info.members_oaddress1"      => "nullable|string|max:100",
            "personal_info.members_oaddress2"      => "nullable|string|max:100",
            "personal_info.members_officecity"     => "nullable|string|max:100",
            "personal_info.members_officedistrict" => "nullable|string|max:100",
            "personal_info.members_officezipcode"  => "nullable|max:4|min:4",
            "personal_info.members_businessname"   => "nullable|string|max:100",
            "personal_info.tele_num"  => "nullable|max:20|regex:/^\d-\d{3}-\d{4}$/",

            // VEHICLE DETAILS
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
            'or_image.*' => [
                'required',
                'image',
                'mimes:jpeg,png,bmp,gif,svg,webp',
                'max:1024', // 1MB
                // 'dimensions:min_width=100,min_height=200',
            ],
            'cr_image.*' => [
                'required',
                'image',
                'mimes:jpeg,png,bmp,gif,svg,webp',
                'max:1024', // 1MB
                // 'dimensions:min_width=100,min_height=200',
            ],
        ];
    }

    public function messages(): array
    {
        return [
                // PERSONAL INFORMATION
            'personal_info.membership_type.required' => 'Membership type is required',
            'personal_info.plantype_id.required'       => 'Plan type is required',
            
            'personal_info.members_title.required' => 'Title is required',
            'personal_info.members_title.in'       => 'Please select a valid title (MR, MS, MRS, ATTY, DR, ENGR)',
            'personal_info.members_title.alpha'    => 'Title must contain only letters',
            
            'personal_info.members_firstname.required' => 'First name is required',
            'personal_info.members_firstname.max'      => 'First name cannot exceed 30 characters',
            
            'personal_info.members_lastname.required' => 'Last name is required',
            'personal_info.members_lastname.max'      => 'Last name cannot exceed 30 characters',
            
            'personal_info.members_gender.required' => 'Gender is required',
            'personal_info.members_gender.in'       => 'Please select a valid gender (MALE or FEMALE)',
            
            'personal_info.members_birthplace.required' => 'Birth place is required',
            'personal_info.members_birthplace.max'      => 'Birth place cannot exceed 30 characters',
            
            'personal_info.occupation_name.required' => 'Occupation is required',
            'personal_info.occupation_name.max'      => 'Occupation cannot exceed 30 characters',
            
            'personal_info.members_birthdate.required' => 'Birth date is required',
            'personal_info.members_birthdate.date'     => 'Please enter a valid date',
            
            'personal_info.members_civilstatus.required' => 'Civil status is required',
            'personal_info.members_civilstatus.in'       => 'Please select a valid civil status (SINGLE, MARRIED, WIDOWED)',
            
            'personal_info.citizenship.required' => 'Citizenship is required',
            'personal_info.citizenship.in'       => 'Please select a valid citizenship (Filipino or Foreigner)',

            'image.required'   => 'An image is required.',
            'image.image'      => 'The file must be an image.',
            'image.mimes'      => 'The image must be a file of type: jpeg, png, bmp, gif, svg, webp.',
            'image.max'        => 'The image may not be greater than 1MB.',
            'image.dimensions' => 'The image has invalid dimensions.',
            
                // CONTACT INFORMATION
            'personal_info.mailing_preference.in' => 'Please select a valid mailing preference (HOUSE ADDRESS or OFFICE ADDRESS)',
            
            'personal_info.members_haddress1.required' => 'House address line 1 is required',
            'personal_info.members_haddress1.max'      => 'House address line 1 cannot exceed 100 characters',
            
            'personal_info.members_haddress2.required' => 'House address line 2 is required',
            'personal_info.members_haddress2.max'      => 'House address line 2 cannot exceed 100 characters',
            
            'personal_info.members_housecity.required' => 'City is required',
            'personal_info.members_housecity.max'      => 'City name cannot exceed 100 characters',
            
            'personal_info.members_housedistrict.required' => 'District is required',
            'personal_info.members_housedistrict.max'      => 'District name cannot exceed 100 characters',
            
            'personal_info.members_housezipcode.required' => 'ZIP code is required',
            'personal_info.members_housezipcode.min'      => 'ZIP code must be 4 digits',
            'personal_info.members_housezipcode.max'      => 'ZIP code must be 4 digits',
            
            'personal_info.members_emailaddress.email' => 'Please enter a valid email address',
            'personal_info.members_emailaddress.max'   => 'Email address cannot exceed 100 characters',
            
            'personal_info.alt_email.email' => 'Please enter a valid alternative email address',
            'personal_info.alt_email.max'   => 'Alternative email cannot exceed 100 characters',
            
                // VEHICLE DETAILS
            'is_cs.*.required' => 'Please specify if this is a company service vehicle',
            'is_cs.*.in'       => 'Invalid company service vehicle specification',
            
            'vehicle_plate.*.required' => 'Vehicle plate number is required',
            'vehicle_plate.*.max'      => 'Vehicle plate number cannot exceed 10 characters',
            
            'vehicle_make.*.required' => 'Vehicle make is required',
            'vehicle_make.*.regex'    => 'Vehicle make can only contain letters, numbers and spaces',
            'vehicle_make.*.max'      => 'Vehicle make cannot exceed 50 characters',
            
            'vehicle_model.*.required' => 'Vehicle model is required',
            'vehicle_model.*.regex'    => 'Vehicle model can only contain letters, numbers and spaces',
            
            'vehicle_type.*.required' => 'Vehicle type is required',
            'vehicle_type.*.regex'    => 'Vehicle type can only contain letters, numbers and spaces',
            
            'vehicle_year.*.required' => 'Vehicle year is required',
            'vehicle_year.*.integer'  => 'Vehicle year must be a valid year',
            'vehicle_year.*.min'      => 'Vehicle year must be 1900 or later',
            'vehicle_year.*.max'      => 'Vehicle year cannot be greater than current year',
            
            'vehicle_color.*.required' => 'Vehicle color is required',
            
            'vehicle_fuel.*.required' => 'Fuel type is required',
            'vehicle_fuel.*.in'       => 'Please select a valid fuel type (GAS, DIESEL, or ELECTRIC)',
            
            'vehicle_transmission.*.required' => 'Transmission type is required',
            'vehicle_transmission.*.in'       => 'Please select a valid transmission type (AUTOMATIC or MANUAL)',
        ];
    }
}
