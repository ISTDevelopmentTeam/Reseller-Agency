<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlanType;
use App\Models\MembershipType;

class NewResellerController extends Controller
{
    public function index(Request $request){
        $members = MembershipType::all();
        $plantype = PlanType::all();
        
        return view('new_reseller')->with([
            'packages' => ['members' => $members, 'plantype' => $plantype]
        ]);
    }
}
