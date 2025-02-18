<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MembershipRequest;
use App\Actions\Agent\Membership\FetchMembership;
use App\Actions\Agent\Membership\StoreMembership;
use App\Actions\Customer\Membership\CustomerMembership;
use App\Actions\Customer\Membership\StoringMembership;
use Illuminate\Support\Facades\DB;
use App\Models\TokenModel;
use Illuminate\Support\Facades\Route;

class MembershipController extends Controller
{
    protected $fetchMembership;
    protected $storeMembership;
    protected $customerMembership;
    protected $storingMembership;
    private $encryption_key;
    private $encryption_iv;

    public function __construct(
        FetchMembership $fetchMembership,
        StoreMembership $storeMembership
        ,
        CustomerMembership $customerMembership,
        StoringMembership $storingMembership
    ) {
        $this->fetchMembership = $fetchMembership;
        $this->storeMembership = $storeMembership;
        $this->customerMembership = $customerMembership;
        $this->storingMembership = $storingMembership;

        $this->encryption_key = base64_decode(env('ENCRYPTION_KEY'));
        $this->encryption_iv = base64_decode(env('ENCRYPTION_IV'));
    }

    public function decrypt($data) {
        $decrypted = openssl_decrypt(base64_decode($data), 'AES-256-CBC',$this->encryption_key  , OPENSSL_RAW_DATA, $this->encryption_iv);
        return $decrypted;
    }

    public function index(Request $request, $membershipId, $planId)
    {
        $data = $this->fetchMembership->handle($request, $membershipId, $planId);
        return view('reseller_form/membership')->with($data);
    }

    public function store(MembershipRequest $request)
    {
        if (!$request->session()->token() === $request->input('_token')) {
            abort(403, 'CSRF token mismatch');
        }

        $this->storeMembership->handle($request);
        return redirect()->route('event_dashboard');
    }


    public function fetch(Request $request, $membershipId, $planId, $token)
    {
        return DB::transaction(function () use ($request, $membershipId, $planId, $token) {
            $temporaryToken = TokenModel::where('token', $token)
                ->where('form_completed', false)  // Only check if form is not completed
                ->lockForUpdate()
                ->first();

            if (!$temporaryToken || $temporaryToken->expires_at < now()) {
                return redirect()->route('webpage_expiration_page')
                    ->with('error', 'This link has expired or is invalid');
            }

            // Update form type
            $temporaryToken->form_type = 'membership';
            $temporaryToken->save();

            // Store in session that this user has access
            session(['form_token_' . $token => true]);

            $data = $this->customerMembership->handle($request, $membershipId, $planId, $token);

            return response()
                ->view('customer_form/membership', $data)
                ->header('Cache-Control', 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0')
                ->header('Pragma', 'no-cache')
                ->header('Expires', '0');
        });
    }
    public function storing(MembershipRequest $request, $token)
    {
        $result = $this->storingMembership->handle($request, $token);

        if ($result === false) {
            return redirect()->route('webpage_expiration_page')
                ->with('error', 'This form has already been submitted or is no longer valid');
        }

        // Redirect to the thank you page
        return redirect()->route('thankyou_membership');
    }
    public function thank(Request $request)
{
    $applicationId = $this->decrypt(session('application_id'));
    $trackingNumber = $this->decrypt(session('tracking_number'));

    if (!$applicationId || !$trackingNumber) {
        return redirect()->route('home')->with('error', 'Application details not found');
    }

    return response()
        ->view('customer_form/thankyou', compact('applicationId', 'trackingNumber'))
        ->header('Cache-Control', 'no-store, no-cache, must-revalidate')
        ->header('Pragma', 'no-cache')
        ->header('Expires', '0');
}

}