<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mews\Purifier\Facades\Purifier;
// use App\Http\Controllers\Log;
use App\Models\PlanType;
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

    public function event_dashboard(){
        $results = PlanType::with('membershipType')->get();
        $planTypes = PlanType::all(); // Get all plan types to populate dropdown
    
        return view('reseller_form/event_dashboard', [
            'results' => $results,
            'planTypes' => $planTypes
        ]);
    }

    
}
