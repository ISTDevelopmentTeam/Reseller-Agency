<?php

namespace App\Http\Controllers;
use App\Models\SubscriptionDetailsModel;
use App\Models\MembershipTypeModal;

use Illuminate\Http\Request;

class CMS_UpdateController extends Controller
{
    public function update(Request $request, $id, $member_id)
    {



        
    $membership_plan_type = SubscriptionDetailsModel::where('plan_id', $id)  // where condition to match the plan_id
    ->update([   // Use update() to update the values
        'plan_name'   => $request->input('edit_plan_type'),
        'plan_amount' => $request->input('edit_amount'),
        'plan_status' => $request->input('edit_status'),
        'remarks'     => $request->input('edit_remarks'),
    ]);

    $membership_type = MembershipTypeModal::where('membership_id', $member_id)  // where condition to match the plan_id
    ->update([   // Use update() to update the values
        'membership_name'   => $request->input('edit_type_of_membership'),
    ]);


    return redirect()->route('subscription_plan_cms')->with('success', 'Subscription plan updated successfully!');


    }
}
