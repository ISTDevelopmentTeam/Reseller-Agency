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

class MembershipController extends Controller
{
    protected $fetchMembership;
    protected $storeMembership;
    protected $customerMembership;
    protected $storingMembership;

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
                ->where('used', true)
                ->where('form_completed', false)
                ->whereNull('form_type')
                ->lockForUpdate()
                ->first();

            if (!$temporaryToken || $temporaryToken->expires_at < now()) {
                return redirect()->route('webpage_expiration_page')
                    ->with('error', 'This link has already been used or already been submitted');
            }

            // Mark this token as being used for membership form
            $temporaryToken->form_type = 'membership';
            $temporaryToken->save();

            $data = $this->customerMembership->handle($request, $membershipId, $planId, $token);

            // Add cache control headers to prevent back button access
            return response()
                ->view('customer_form/membership', $data)
                ->header('Cache-Control', 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0')
                ->header('Pragma', 'no-cache')
                ->header('Expires', '0');
        });
    }

    public function storing(MembershipRequest $request, $token)
    {
        $this->storingMembership->handle($request, $token);

        return redirect()->route('thankyou');
    }

    public function thank()
    {
        return response()
            ->view('customer_form/thankyou')
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }
}