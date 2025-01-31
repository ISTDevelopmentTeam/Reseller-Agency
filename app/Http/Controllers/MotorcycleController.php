<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MotorcycleRequest;
use App\Actions\Agent\Motorcycle\FetchMotorcycle;
use App\Actions\Agent\Motorcycle\StoreMotorcycle;
use App\Actions\Customer\Motorcycle\CustomerMotorcycle;
use App\Actions\Customer\Motorcycle\StoringMotorcycle;
use Illuminate\Support\Facades\DB;
use App\Models\TokenModel;


class MotorcycleController extends Controller
{
    protected $fetchMotorcycle;
    protected $storeMotorcycle;
    protected $customerMotorcycle;
    protected $storingMotorcycle;

    public function __construct(
        FetchMotorcycle $fetchMotorcycle,
        StoreMotorcycle $storeMotorcycle,
        CustomerMotorcycle $customerMotorcycle,
        StoringMotorcycle $storingMotorcycle
    ) {
        $this->fetchMotorcycle = $fetchMotorcycle;
        $this->storeMotorcycle = $storeMotorcycle;
        $this->customerMotorcycle = $customerMotorcycle;
        $this->storingMotorcycle = $storingMotorcycle;
    }

    public function index(Request $request, $planId)
    {
        $data = $this->fetchMotorcycle->handle($request, $planId);
        return view('reseller_form/motorcycle')->with($data);
    }

    public function store(MotorcycleRequest $request)
    {
        if (!$request->session()->token() === $request->input('_token')) {
            abort(403, 'CSRF token mismatch');
        }

        $this->storeMotorcycle->handle($request);
        return redirect()->route('event_dashboard');
    }

    public function fetch(Request $request, $planId, $token)
    {
        return DB::transaction(function () use ($request, $planId, $token) {
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

            // Mark this token as being used for motorcycle form
            $temporaryToken->form_type = 'motorcycle';
            $temporaryToken->save();

            $data = $this->customerMotorcycle->handle($request, $planId, $token);

            return response()
                ->view('customer_form/motorcycle', $data)
                ->header('Cache-Control', 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0')
                ->header('Pragma', 'no-cache')
                ->header('Expires', '0');
        });
    }

    public function storing(MotorcycleRequest $request, $token)
    {
        $data = $this->storingMotorcycle->handle($request, $token);

        if ($data === false) {
            return redirect()->route('webpage_expiration_page');
        }
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
