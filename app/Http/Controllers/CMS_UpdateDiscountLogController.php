<?php

namespace App\Http\Controllers;
use App\Models\discounted_logs_model;
use App\Models\SubscriptionDetailsModel;
use App\Models\MembershipTypeModal;
use Carbon\Carbon;

use Illuminate\Http\Request;

class CMS_UpdateDiscountLogController extends Controller
{
    public function update(Request $request, $id)
    {

        
        
        $discount_logs = discounted_logs_model::create([  
            'plan_id'             => $id,  
            'discount_amount'     =>  $request->input('amount_discount'),  // Default to 0 if not provided
            'discount_start'      => $request->input('start_discount'),
            'discount_end'        => $request->input('end_discount'),
            'added_by'            => '242',
            'added_when'          => Carbon::now(),
        ]);
        

    return redirect()->route('subscription_plan_cms')->with('success', 'Subscription plan updated successfully!');


    }
}
