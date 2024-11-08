<?php

namespace App\Http\Controllers;
use App\Models\SubscriptionDetailsModel;
use App\Models\MembershipTypeModal;
use Illuminate\Http\Request;

class CMSAddPageController extends Controller
{
    public function index(){


        
        $membership_plans_and_types = SubscriptionDetailsModel::leftJoin('membership_type', 'membership_plantype.membership_id', '=', 'membership_type.membership_id')
        ->select('membership_plantype.*', 'membership_type.*')  // Select all columns from both tables
        ->get();

        $membership_plantype = MembershipTypeModal::all();



return view('add_cms', data: compact( 'membership_plans_and_types', 'membership_plantype'));



    }
}
