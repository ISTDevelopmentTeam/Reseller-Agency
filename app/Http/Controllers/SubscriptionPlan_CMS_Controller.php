<?php

namespace App\Http\Controllers;

use App\Models\DiscountedLogsModel;  
use App\Models\SubscriptionDetailsModel;
use App\Models\MembershipTypeModal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubscriptionPlan_CMS_Controller extends Controller
{
    public function index()
    {
        // Fixing join and selecting specific columns for $details
        $details = SubscriptionDetailsModel::leftJoin('membership_type', 'membership_plantype.membership_id', '=', 'membership_type.membership_id')
            ->select('membership_plantype.*', 'membership_type.membership_name')  // Adjust as needed
            ->paginate(7);

        // Fetch all membership types
        $membership_plantype = MembershipTypeModal::all();

        // Set the updated timestamp for the view
        $updated = now();  // or any other value you want to pass to the view

        // Return the view with the results
        return view('subscription_plan_cms', compact('details', 'updated', 'membership_plantype'));
    }

    public function updatePlan(Request $request)
    {
        // Validation
        $validated = $request->validate([
            'membership_id' => 'required',
            'plan_id' => 'required',
            'membership_name' => 'required',
            'plan_name' => 'required',
            'plan_amount' => 'required|numeric',
            'remarks' => 'nullable',
            'plan_status' => 'required|in:ACTIVE,INACTIVE'
        ]);

        // Update Subscription Details
        SubscriptionDetailsModel::where('plan_id', $request->plan_id)
            ->where('membership_id', $request->membership_id)
            ->update([
                'plan_name' => $request->plan_name,
                'plan_amount' => $request->plan_amount,
                'remarks' => $request->remarks,
                'plan_status' => $request->plan_status
            ]);

        // Update Membership Type
        MembershipTypeModal::where('membership_id', $request->membership_id)
            ->update([
                'membership_name' => $request->membership_name
            ]);

        return redirect()->back()->with('success', 'Plan updated successfully');
    }

    public function addMembership(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'membership_name' => 'required|string|max:255',
            'plan_name' => 'required|string|max:255',
            'plan_amount' => 'required|numeric|min:0',
            'remarks' => 'nullable|string',
            'plan_status' => 'required|in:ACTIVE,INACTIVE',
        ]);

        try {
            DB::beginTransaction();

            // Create a new membership type
            $membershipType = MembershipTypeModal::create([
                'membership_name' => $validated['membership_name']
            ]);

            // Then, create the subscription details with the new membership_id
            SubscriptionDetailsModel::create([
                'membership_id' => $membershipType->membership_id,
                'plan_name' => $validated['plan_name'],
                'plan_amount' => $validated['plan_amount'],
                'remarks' => $validated['remarks'],
                'plan_status' => $validated['plan_status']
            ]);

            DB::commit();

            return redirect()->back()->with('success', 'Membership plan added successfully!');

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()
                ->with('error', 'Failed to add membership plan: ' . $e->getMessage())
                ->withInput();
        }
    }
}
