<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PidpRequest;
use App\Actions\Agent\Pidp\FetchPidp;
use App\Actions\Agent\Pidp\StorePidp;
use App\Actions\Customer\Pidp\CustomerPidp;
use App\Actions\Customer\Pidp\StoringPidp;
use App\Models\TokenModel;
use Illuminate\Support\Facades\DB;

class PidpController extends Controller
{
    protected $fetchPidp;
    protected $storePidp;
    protected $customerPidp;
    protected $storingPidp;
    public function __construct(FetchPidp $fetchPidp, StorePidp $storePidp, CustomerPidp $customerPidp, StoringPidp $storingPidp
    ) {
        $this->fetchPidp    = $fetchPidp;
        $this->storePidp    = $storePidp;
        $this->customerPidp = $customerPidp;
        $this->storingPidp  = $storingPidp;
    }

    public function index(Request $request, $membershipId, $planId)
    {
        $data = $this->fetchPidp->handle($request, $membershipId, $planId);
        return view('reseller_form/pidp')->with($data);
    }

    public function store(PidpRequest $request)
    {
        $this->storePidp->handle($request);
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
            $temporaryToken->form_type = 'pidp';
            $temporaryToken->save();
    
            // Store in session that this user has access
            session(['form_token_' . $token => true]);
    
            $data = $this->customerPidp->handle($request, $membershipId, $planId, $token);
    
            return response()
                ->view('customer_form/pidp', $data)
                ->header('Cache-Control', 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0')
                ->header('Pragma', 'no-cache')
                ->header('Expires', '0');
        });
    }

    public function storing(PidpRequest $request, $token)
    {
        return DB::transaction(function () use ($request, $token) {
            $temporaryToken = TokenModel::where('token', $token)
                ->where('used', true)
                ->where('form_type', 'pidp')
                ->where('form_completed', false)
                ->lockForUpdate()
                ->first();
    
            if (!$temporaryToken || $temporaryToken->expires_at < now()) {
                return redirect()->route('webpage_expiration_page')
                    ->with('error', 'This link has expired or has already been used');
            }
    
            // Process form submission
            $this->storingPidp->handle($request, $token);
    
            // Mark as completed after successful storage
            $temporaryToken->form_completed = true;
            $temporaryToken->save();
    
            return redirect()->route('thankyou');
        });
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
