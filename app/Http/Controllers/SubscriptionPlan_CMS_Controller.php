<?php

namespace App\Http\Controllers;
use App\Models\discounted_logs_model;
use App\Models\SubscriptionDetailsModel;
use App\Models\MembershipTypeModal;

use Illuminate\Http\Request;

class SubscriptionPlan_CMS_Controller extends Controller
{
    public function index(){

                // Fetch all users

                $updated = discounted_logs_model::leftJoin('membership_plantype', 'membership_discount.plan_id', '=', 'membership_plantype.plan_id')
                ->select('membership_discount.*', 'membership_plantype.*') // Select all columns from both tables
                ->get();


                $details = SubscriptionDetailsModel::leftJoin('membership_type', 'membership_plantype.membership_id', '=', 'membership_type.membership_id')
                ->select('membership_plantype.*', 'membership_type.*')  // Select all columns from both tables
                ->get();

                $membership_plantype = MembershipTypeModal::all();
            

        return view('subscription_plan_cms', data: compact('details', 'updated', 'membership_plantype'));

        
    }
}
