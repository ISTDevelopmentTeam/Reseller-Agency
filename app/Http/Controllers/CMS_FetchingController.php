<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\discounted_logs_model;
use App\Models\SubscriptionDetailsModel;
use App\Models\MembershipTypeModal;
class CMS_FetchingController extends Controller
{

// Data Table For CMS
public function cms_fetch(){

    // Fetch all users

    $updated = discounted_logs_model::leftJoin('membership_plantype', 'membership_discount.plan_id', '=', 'membership_plantype.plan_id')
    ->select('membership_discount.*', 'membership_plantype.*') // Select all columns from both tables
    ->get();


    $details = SubscriptionDetailsModel::leftJoin('membership_type', 'membership_plantype.membership_id', '=', 'membership_type.membership_id')
    ->select('membership_plantype.*', 'membership_type.*')  // Select all columns from both tables
    ->paginate(7); 

    $membership_plantype = MembershipTypeModal::all();


return view('subscription_plan_cms', data: compact('details', 'updated', 'membership_plantype'));


}


    // Adding Function
    public function add_fetching(){


        
        $membership_plans_and_types = SubscriptionDetailsModel::leftJoin('membership_type', 'membership_plantype.membership_id', '=', 'membership_type.membership_id')
        ->select('membership_plantype.*', 'membership_type.*')  // Select all columns from both tables
        ->get();

        $membership_plantype = MembershipTypeModal::all();



    return view('add_cms', data: compact( 'membership_plans_and_types', 'membership_plantype'));



    }

// End Of Adding Function






    // Viewing of Fetch
    public function Edit_Fetch(Request $request){

        // Fetch all users

        $data = $request->all(); // This will capture all parameters



        
                // Fetch all Details infomration


                $membership_plans_and_types = SubscriptionDetailsModel::leftJoin('membership_type', 'membership_plantype.membership_id', '=', 'membership_type.membership_id')
                ->select('membership_plantype.*', 'membership_type.*')  // Select all columns from both tables
                ->get();

                $membership_plantype = MembershipTypeModal::all();

    

        return view('edit_cms', data: compact('data', 'membership_plans_and_types', 'membership_plantype'));


}




// End of Edit Function



public function View_Fetch(Request $request){

    // Fetch all users

    $data = $request->all(); // This will capture all parameters

    $id = $request->input('plan_id');

    
    
            // Fetch all Details infomration


            $membership_plans_and_types = SubscriptionDetailsModel::leftJoin('membership_type', 'membership_plantype.membership_id', '=', 'membership_type.membership_id')
            ->select('membership_plantype.*', 'membership_type.*')
            ->get();

            $membership_plantype = MembershipTypeModal::all();

             $discount_logs = discounted_logs_model::where('plan_id', $id)->get();


    return view('view_cms', data: compact('data', 'membership_plans_and_types', 'membership_plantype', 'discount_logs'));


}

public function fetch_drop_down_data($membership_id) {
    $fetched = SubscriptionDetailsModel::leftJoin('membership_type', 'membership_plantype.membership_id', '=', 'membership_type.membership_id')
    ->select('membership_plantype.*', 'membership_type.*')
    ->where('membership_type.membership_name', $membership_id) // Apply a condition on membership_type
    ->get();

    return response()->json($fetched);
}



}
