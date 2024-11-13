<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\discounted_logs_model;
use App\Models\SubscriptionDetailsModel;
use App\Models\MembershipTypeModal;
use Carbon\Carbon;
class CMSController extends Controller
{


    // Adding Function
    public function add(Request $request)
    {
     
        // Use the model to create a new record in the database
        SubscriptionDetailsModel::create([
            'plantype_id'           => '0',
            'membership_id'         => $request->input('add_membership_name'),
            'plan_name'             => $request->input('add_membership_plantype'),
            'plan_amount'           => $request->input('plan_amount'),
            'plan_status'           => $request->input('plan_status'),
            'added_when'            => Carbon::now(),
            'added_by'              => '0',
            'update_by'             => '0',
            'update_when'           => Carbon::now(),
            'remarks'               => $request->input('remarks'),

        ]);

    // Redirect with a success message
    return redirect()->route('subscription_plan_cms')->with('success', 'Subscription plan updated successfully!');

    }


    // Update Function
    public function update(Request $request)
    {

        $id = $request->input('plan_id');
        $member_id = $request->input('membership_id');

    $membership_plan_type = SubscriptionDetailsModel::where('plan_id', $id)  // where condition to match the plan_id
    ->update([   // Use update() to update the values
        'plan_name'   => $request->input('edit_membership_plantype'),
        'plan_amount' => $request->input('edit_plan_amount'),
        'plan_status' => $request->input('edit_plan_status'),
        'remarks'     => $request->input('edit_remarks'),
    ]);

    $membership_type = MembershipTypeModal::where('membership_id', $member_id)  // where condition to match the plan_id
    ->update([   // Use update() to update the values
        'membership_name'   => $request->input('edit_membership_name'),
    ]);


    return redirect()->route('subscription_plan_cms')->with('success', 'Subscription plan updated successfully!');


    }

}
