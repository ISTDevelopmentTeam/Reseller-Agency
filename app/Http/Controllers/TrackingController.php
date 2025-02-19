<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Membership;

class TrackingController extends Controller
{
    protected $token;
    private $encryption_key;
    private $encryption_iv;

    public function __construct()
    {
        $this->encryption_key = base64_decode(env('ENCRYPTION_KEY'));
        $this->encryption_iv = base64_decode(env('ENCRYPTION_IV'));
    }
    public function decrypt($data) {
        $decrypted = openssl_decrypt(base64_decode($data), 'AES-256-CBC',$this->encryption_key  , OPENSSL_RAW_DATA, $this->encryption_iv);
        return $decrypted;
    }
    public function index()
    {
        return view('tracking_page.application_acc');
    }

    public function track(Request $request)
{
    $request->validate([
        'applicationId' => 'required|string'
    ]);

    $applicationId = $request->input('applicationId');

    // Search for exact match
    $membership = Membership::where('application_track_no', $applicationId)->first();

    if ($membership) {
        // Decrypt the necessary fields
        $decryptedMembership = (object)[
            'members_lastname'     => $this->decrypt($membership->members_lastname),
            'members_birthdate'    => $this->decrypt($membership->members_birthdate),
            'members_emailaddress' => $this->decrypt($membership->members_emailaddress),
            'members_mobileno'     => $this->decrypt($membership->members_mobileno),
            'application_track_no' => $membership->application_track_no,
            'membership_type'      => $membership->membership_type,
            'plan_type'            => $membership->plan_type,
            'application_date'     => $membership->application_date,
            'status'               => $membership->status,
            'members_firstname'    => $membership->members_firstname,
            'members_middlename'   => $membership->members_middlename,
        ];

        // dd($decryptedMembership);

        // Pass the decrypted data to the view
        return view('tracking_page.application_view', ['membership' => $decryptedMembership]);
    }

    // If not found, return back with error message
    return back()->with('error', 'No application found with this ID. Please check and try again.');
}

}