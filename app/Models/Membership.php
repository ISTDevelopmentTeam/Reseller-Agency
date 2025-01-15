<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MemberVihicleModel;

class Membership extends Model
{
    // use HasFactory;

    protected $table = "members_application";

    protected $primaryKey = "application_id";

    public $timestamps = false;

    protected $fillable = [
        // Add all the fields you want to be mass-assignable
        'typesofapplication',
        'membership_type',
        'plan_type',
        'plantype_id',
        'activation_date',
        'pin_code',
        'initiator',
        'pa_insurance',
        'category',
        'platform',
        'idpicture',
        'option',
        'representative_name',
        
        // Personal Info Fields
        'members_title',
        'members_lastname',
        'members_firstname',
        'members_middlename',
        'members_gender',
        'members_birthdate',
        'members_birthplace',
        'citizenship',
        'nationality',
        'members_civilstatus',
        'occupation_name',
        
        // Contact Info
        'members_mobileno',
        'members_alternate_mobileno',
        'members_emailaddress',
        'members_alternate_emailaddress',
        'tele_num',
        
        // Address Fields
        'mailing_preference',
        'members_haddress1',
        'members_haddress2',
        'members_housecity',
        'members_housedistrict',
        'members_housezipcode',
        
        'members_businessname',
        'members_oaddress1',
        'members_oaddress2',
        'members_officecity',
        'members_officedistrict',
        'members_officezipcode',

        // BENEFICIARIES
        'insured1',
        'beneficiary1',
        'relation1',
        'bday_insured1',
        'insured2',
        'beneficiary2',
        'relation2',
        'bday_insured2',
        'insured3',
        'beneficiary3',
        'relation3',
        'bday_insured3',
        
        // Additional Fields
        'avail_magazine',
        'application_date',
        'status'
    ];

    public function vehicles()
    {
        return $this->hasMany(MemberVihicleModel::class, 'application_id', 'application_id');
    }
}
