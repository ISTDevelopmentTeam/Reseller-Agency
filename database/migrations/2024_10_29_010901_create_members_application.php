<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('members_application', function (Blueprint $table) {
            $table->id();
            $table->string('option', 225);
            $table->string('category', 225);
            $table->string('platform', 225);
            $table->string('typesofapplication', 225);
            $table->string('branch', 225);
            $table->integer('plantype_id');
            $table->string('pidp_plantype', 225);
            $table->string('membership_type', 225);
            $table->string('idpicture', 225);
            $table->integer('members_id', 11);
            $table->integer('record_no', 11);
            $table->integer('record_id', 11);
            $table->string('pincode', 225);
            $table->longText('members_title');
            $table->string('members_lastname', 225);
            $table->string('members_firstname', 225);
            $table->string('members_middlename', 225);
            $table->string('members_birthdate', 225);
            $table->string('members_birthplace', 225);
            $table->text('members_gender');
            $table->string('members_civilstatus', 225);
            $table->string('occupation_name', 225);
            $table->string('citizenship', 225);
            $table->string('nationality', 225);
            $table->string('members_licenseno', 225);
            $table->string('members_licensetype', 225);
            $table->string('members_licensecard', 225);
            $table->string('members_licenseexpirationdate', 225);
            $table->string('members_licenserest', 225);
            $table->string('members_licensedlcode', 225);
            $table->string('members_haddress1', 225);
            $table->string('members_haddress2', 225);
            $table->string('members_housecity', 225);
            $table->string('members_housedistrict', 225);
            $table->string('members_housezipcode', 225);
            $table->string('members_mobileno', 225);
            $table->string('members_alternate_mobileno', 225);
            $table->string('members_emailaddress', 225);
            $table->string('members_alternate_emailaddress', 225);
            $table->string('alt_email', 225);
            $table->string('members_oaddress1', 225);
            $table->string('members_oaddress2', 225);
            $table->string('members_officecity', 225);
            $table->string('members_officedistrict', 225);
            $table->string('members_officezipcode', 225);
            $table->string('members_businessname', 225);
            $table->string('members_housephoneno', 225);
            $table->string('tele_num', 225);
            $table->string('pidp', 225);
            $table->string('members_destination', 225);
            $table->string('members_destination2', 225);
            $table->string('members_purposetravel', 225);
            $table->string('members_alternate_tel', 225);

            $table->string('application_date', 225);
            $table->string('status', 225);
            $table->string('remarks', 225);
            $table->string('is_aq', 225);
            $table->string('agreeDP', 225);
            $table->string('agree', 225);
            $table->string('representative_name', 225);
            $table->string('representative_contactno', 225);
            $table->string('representative_address', 225);
            $table->string('representative_age', 225);
            $table->string('mailing_preference', 225);
            $table->string('insured1', 225);
            $table->string('beneficiary1', 225);
            $table->string('relation1', 225);
            $table->string('bday_insured1', 225);
            $table->string('insured2', 225);
            $table->string('beneficiary2', 225);
            $table->string('relation2', 225);
            $table->string('bday_insured2', 225);
            $table->string('insured3', 225);
            $table->string('beneficiary3', 225);
            $table->string('relation3', 225);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members_application');
    }
};
