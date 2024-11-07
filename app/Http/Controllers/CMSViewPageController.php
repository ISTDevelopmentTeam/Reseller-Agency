<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;
use App\Models\SubscriptionDetailsModel;
use App\Models\discounted_logs_model;
use App\Models\MembershipTypeModal;
use Illuminate\Http\Request;

class CMSViewPageController extends Controller
{
    
    public function index(Request $request){

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

}
