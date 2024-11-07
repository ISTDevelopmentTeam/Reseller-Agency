<?php

namespace App\Http\Controllers;
use App\Models\SubscriptionDetailsModel;

use Illuminate\Http\Request;

class SubscriptionPlanController extends Controller
{
    
    public function index(){

        
                // Fetch all users
                $details = SubscriptionDetailsModel::all();

        return view('subscription_plan', data: compact('details'));


    }

    
}
