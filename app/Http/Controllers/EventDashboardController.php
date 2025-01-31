<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mews\Purifier\Facades\Purifier;
// use App\Http\Controllers\Log;
use App\Models\PlanType;
use App\Models\TokenModel;
use App\Models\MembershipType;
use App\Models\Town;
use App\Models\SubscriptionDetailsModel;
use App\Http\Requests\MembersRequest;
use App\Models\City;
use App\Models\Membership;
use App\Models\Vehicle;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Traits\Insurance\Get_carmake;

class EventDashboardController extends Controller
{
    use Get_carmake;

    public function event_dashboard()
    {
        $results = PlanType::with('membershipType')->get();
        $planTypes = PlanType::all(); // Get all plan types to populate dropdown

        return view('reseller_form/event_dashboard', [
            'results' => $results,
            'planTypes' => $planTypes
        ]);
    }

    public function customer_event_dashboard($token)
    {
        return DB::transaction(function () use ($token) {
            $temporaryToken = TokenModel::where('token', $token)
                ->lockForUpdate()
                ->first();

            // Check if token exists, is expired, or already accessed a form
            if (
                !$temporaryToken ||
                $temporaryToken->expires_at < now() ||
                $temporaryToken->form_completed ||
                !empty($temporaryToken->form_type) ||
                $temporaryToken->used  // Add this to check if dashboard was already accessed
            ) {
                return redirect()->route('webpage_expiration_page')
                    ->with('error', 'This link has expired or has already been used');
            }

            // Mark token as used for dashboard access
            $temporaryToken->used = true;
            $temporaryToken->save();

            $membershipTypes = MembershipType::where('membership_status', 'ACTIVE')
                ->with([
                    'planTypes' => function ($query) {
                        $query->where('plan_status', 'ACTIVE')
                            ->orderBy('plan_amount');
                    }
                ])
                ->orderBy('membership_id')
                ->get();

            return view('customer_form/event_dashboard', [
                'membershipTypes' => $membershipTypes,
                'token' => $token
            ]);
        });
    }
}
