<?php

namespace App\Http\Controllers;

use App\Models\SubscriptionDetailsModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CMS_AddController extends Controller
{
    public function store(Request $request)
    {
     
        // Use the model to create a new record in the database
        SubscriptionDetailsModel::create([
            'plantype_id'             => '0',
            'membership_id'         => $request->input('add_type_of_membership'),
            'plan_name'             => $request->input('add_plan_type'),
            'plan_amount'           => $request->input('add_amount'),
            'plan_status'           => $request->input('add_status'),
            'added_when'            => Carbon::now(),
            'added_by'              => '0',
            'update_by'             => '0',
            'update_when'           => Carbon::now(),
            'remarks'               => $request->input('add_remarks'),

        ]);

    // Redirect with a success message
    return redirect()->route('subscription_plan_cms')->with('success', 'Subscription plan updated successfully!');

    }
}
