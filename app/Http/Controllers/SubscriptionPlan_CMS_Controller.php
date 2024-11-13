<?php

namespace App\Http\Controllers;
use App\Models\discounted_logs_model;
use App\Models\SubscriptionDetailsModel;
use App\Models\MembershipTypeModal;
use Illuminate\Http\Request;

class SubscriptionPlan_CMS_Controller extends Controller
{
    public function index()
    {
       
        $details = SubscriptionDetailsModel::leftJoin('membership_type', 'membership_plantype.membership_id', '=', 'membership_type.membership_id')
            ->select('membership_plantype.*', 'membership_type.*')  
            ->paginate(7); 



       
        $updated = discounted_logs_model::leftJoin('membership_plantype', 'membership_discount.plan_id', '=', 'membership_plantype.plan_id')
            ->select('membership_discount.*', 'membership_plantype.*') 
            ->get();


        $membership_plantype = MembershipTypeModal::all();

        return view('subscription_plan_cms', compact('details', 'updated', 'membership_plantype'));
    }

    public function updatePlan(Request $request)
    {
        $validated = $request->validate([
            'membership_id' => 'required',
            'plan_id' => 'required',
            'membership_name' => 'required',
            'plan_name' => 'required',
            'plan_amount' => 'required|numeric',
            'remarks' => 'nullable',
            'plan_status' => 'required|in:ACTIVE,INACTIVE'
        ]);

        SubscriptionDetailsModel::where('plan_id', $request->plan_id)
            ->where('membership_id', $request->membership_id)
            ->update([
                'plan_name' => $request->plan_name,
                'plan_amount' => $request->plan_amount,
                'remarks' => $request->remarks,
                'plan_status' => $request->plan_status
            ]);

        MembershipTypeModal::where('membership_id', $request->membership_id)
            ->update([
                'membership_name' => $request->membership_name
            ]);

        return redirect()->back()->with('success', 'Plan updated successfully');
    }

    
}