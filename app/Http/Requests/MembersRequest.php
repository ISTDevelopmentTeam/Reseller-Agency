<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
class MembersRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {

        return [
            "personal_info.option"                   => "required|string",
            "personal_info.representative_name"      => "nullable|string",
            "personal_info.representative_contactno" => "nullable|string",
            "personal_info.representative_address"   => "nullable|string",
            // "personal_info.representative_age"       => "nullable|integer|max:100|min:1",
            "personal_info.membership_type"          => "required|string",
            "personal_info.plan_type"                => "required|string",
            // "personal_info.reference_number"         => "string",
            "personal_info.members_title"            => "required|string|alpha",
            "personal_info.members_firstname"        => "required|string",
            "personal_info.members_lastname"         => "required|string",
            "personal_info.members_gender"           => "required|string|alpha",
            "personal_info.members_birthplace"       => "required|string",
            "personal_info.occupation_name"          => "required|string",
            "personal_info.members_civilstatus"      => "required|string|alpha",
            "personal_info.citizenship"              => "required|string|alpha",
            "personal_info.nationality"              => "nullable|string",


            "personal_info.mailing_preference"     => "required|string|alpha",
            "personal_info.members_haddress1"      => "required|string",
            "personal_info.members_haddress2"      => "required|string",
            "personal_info.members_housecity"      => "required|string",
            "personal_info.members_housedistrict"  => "required|string",
            "personal_info.members_housezipcode"   => "required|max:4|min:4",
            // "personal_info.members_mobileno"       => "nullable|max:11|min:11",
            // "personal_info.members_housephoneno"   => "nullable|max:20|min:11",
            // "personal_info.members_emailaddress"   => "nullable|email|string|max:100",
            // "personal_info.alt_email"              => "nullable|email|string|max:100",
            "personal_info.members_oaddress1"      => "nullable|string",
            "personal_info.members_oaddress2"      => "nullable|string",
            "personal_info.members_officecity"     => "nullable|string",
            "personal_info.members_officedistrict" => "nullable|string",
            "personal_info.members_officezipcode"  => "nullable|max:4|min:4",
            "personal_info.members_businessname"   => "nullable|string",
            "personal_info.tele_num"               => "nullable|numeric",


            "vehicle1.ve1"                    => "nullable",
            "vehicle1.vehicle_plate1"         => "string",
            "vehicle1.vehicle_model1"         => "string",
            "vehicle1.vehicle_make1"          => "string", //removed string
            "vehicle1.vehicle_color1"         => "string",
            "vehicle1.vehicle_year1"          => "numeric|between:1920,2024", // changed from 2023 to 2024
            "vehicle1.vehicle_fuel1"          => "string|alpha",
            "vehicle1.vehicle_transmission1"  => "string|alpha",
            "vehicle1.v2e"                    => "nullable",
            "vehicle1.vehicle_plate2"         => "nullable|string", //removed min|max
            "vehicle1.vehicle_model2"         => "nullable|string",
            "vehicle1.vehicle_make2"          => "nullable", //removed string
            "vehicle1.vehicle_color2"         => "nullable|string|alpha",
            "vehicle1.vehicle1[vehicle_year2" => "nullable|numeric|between:1920,2024", // changed from 2023 to 2024
            "vehicle1.vehicle_fuel2"          => "nullable|string|alpha",
            "vehicle1.vehicle_transmission2"  => "nullable|string|alpha",
        ];
    }
    // public function messages() {
    //     return [
    //         "personal_info.option.required" => "This field is required.",
    //         "personal_info.option.alpha" => "This field should only contain letters.",
    //         "personal_info.representative_name.alpha" => "This field should only contain letters.",
    //         "personal_info.representative_num.alpha" => "This field should only contain letters.",
    //         "personal_info.representative_add.alpha" => "This field should only contain letters.",
    //         "personal_info.membership_type.required" => "This field is required.",
    //         "personal_info.membership_type.alpha" => "This field should only contain letters.",
    //         "personal_info.plan_type.required" => "This field is required.",
    //         "personal_info.title_membership.required" => "This field is required.",
    //         "personal_info.title_membership.alpha" => "This field should only contain letters.",
    //         "personal_info.fname.required" => "This field is required.",
    //         "personal_info.fname.alpha" => "This field should only contain letters.",
    //         "personal_info.mname.alpha" => "This field should only contain letters.",
    //         "personal_info.lname.required" => "This field is required.",
    //         "personal_info.lname.alpha" => "This field should only contain letters.",
    //         "personal_info.birth_month.required" => "This field is required.",
    //         "personal_info.birth_month.alpha" => "This field should only contain letters.",
    //         "personal_info.bday_date.required" => "This field is required.",
    //         "personal_info.bday_date.numeric" => "This field must be a number.",
    //         "personal_info.bday_date.between" => "This field must be between 1 and 31.",
    //         "personal_info.bday_year.required" => "This field is required.",
    //         "personal_info.bday_year.numeric" => "This field must be a number.",
    //         "personal_info.bday_year.between" => "This field must be a valid year.",
    //         "personal_info.gender_membership.required" => "This field is required.",
    //         "personal_info.gender_membership.alpha" => "This field should only contain letters.",
    //         "personal_info.occupation.required" => "This field is required.",
    //         "personal_info.occupation.alpha" => "This field should only contain letters.",
    //         "personal_info.civil_status.required" => "This field is required.",
    //         "personal_info.civil_status.alpha" => "This field should only contain letters.",
    //         "personal_info.ctzen_membership.required" => "This field is required.",
    //         "personal_info.ctzen_membership.alpha" => "This field should only contain letters.",
    //         "personal_info.nationality.alpha" => "This field should only contain letters.",


    //         "personal_info.mailing_address.required" => "This field is required.",
    //         "personal_info.mailing_address.alpha" => "This field should only contain letters.",
    //         "personal_info.street.required" => "This field is required.",
    //         "personal_info.brgy.required" => "This field is required.",
    //         "personal_info.city.required" => "This field is required.",
    //         "personal_info.province.required" => "This field is required.", 
    //         "personal_info.zipcode.required" => "This field is required.",
    //         "personal_info.zipcode.max" => "This field must be exactly 4 characters long.",
    //         "personal_info.zipcode.min" => "This field must be exactly 4 characters long.",
    //         "personal_info.mobile_num.required" => "This field is required.",
    //         "personal_info.mobile_num.max" => "This field must be exactly 11 digits long.",
    //         "personal_info.mobile_num.min" => "This field must be exactly 11 digits long.",
    //         "personal_info.alt_mobile_num.max" => "This field must be exactly 11 digits long.",
    //         "personal_info.alt_mobile_num.min" => "This field must be exactly 11 digits long.",
    //         "personal_info.email.required" => "This field is required.",
    //         "personal_info.email.email" => "This field must be a valid email format.", 
    //         "personal_info.email.max" => "This field must not exceed 100 characters.",
    //         "personal_info.alt_email.email" => "This field must be a valid email format.", 
    //         "personal_info.alt_email.max" => "This field must not exceed 100 characters.",
    //         "personal_info.off_zipcode.max" => "This field must be exactly 4 characters long.",
    //         "personal_info.off_zipcode.min" => "This field must be exactly 4 characters long.", 
    //         "personal_info.tele_num.numeric" => "This field must be a numeric value.",

            
    //         "vehicle1.plate_num.required" => "This field is required.",
    //         "vehicle1.model.required" => "This field is required.", 
    //         "vehicle1.make.required" => "This field is required.", 
    //         "vehicle1.make.alpha" => "This field should only contain letters.",
    //         "vehicle1.color.required" => "This field is required.", 
    //         "vehicle1.color.alpha" => "This field should only contain letters.",
    //         "vehicle1.year_model.required" => "This field is required.",
    //         "vehicle1.year_model.numeric" => "This field must be a numeric value.",
    //         "vehicle1.year_model.between" => "This field must be between a valid year.",
    //         "vehicle1.ftype.required" => "This field is required.", 
    //         "vehicle1.ftype.alpha" => "This field should only contain letters.",
    //         "vehicle1.ttype.required" => "This field is required.", 
    //         "vehicle1.ttype.alpha" => "This field should only contain letters.",
    //         "vehicle1.add_plate_num.max" => "This field must not exceed 6 characters.",
    //         "vehicle1.add_plate_num.min" => "This field must be at least 6 characters.",
    //         "vehicle1.add_color.alpha" => "This field should only contain letters.",
    //         "vehicle1.add_year_model.numeric" => "This field must be a numeric value.",
    //         "vehicle1.add_year_model.between" => "This field must be a valid year.",
    //         "vehicle1.add_ftype.alpha" => "This field should only contain letters.",
    //         "vehicle1.add_ttype.alpha" => "This field should only contain letters.",
    //     ];
    // }
}
