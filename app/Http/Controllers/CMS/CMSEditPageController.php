<?php


namespace App\Http\Controllers;
use App\Models\SubscriptionDetailsModel;
use App\Models\discounted_logs_model;
use App\Models\MembershipTypeModal;

use Illuminate\Http\Request;

class CMSEditPageController extends Controller
{
    public function index(Request $request){

        // Fetch all users

        $data = $request->all(); // This will capture all parameters



        
                // Fetch all Details infomration


                $membership_plans_and_types = SubscriptionDetailsModel::leftJoin('membership_type', 'membership_plantype.membership_id', '=', 'membership_type.membership_id')
                ->select('membership_plantype.*', 'membership_type.*')  // Select all columns from both tables
                ->get();

                $membership_plantype = MembershipTypeModal::all();

    

        return view('edit_cms', data: compact('data', 'membership_plans_and_types', 'membership_plantype'));


}

}
