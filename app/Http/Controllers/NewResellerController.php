<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlanType;
use App\Models\MembershipType;
use App\Models\Town;
use App\Models\City;

class NewResellerController extends Controller
{
    public function index(Request $request){
        // Membership Type and Plan Type
        $members  = MembershipType::all();
        $plantype = PlanType::all();

        $searchTerm = $request->input('town');

        $towns = Town::select('a.*', 'c.*', 'd.*')
            ->from('aap_zipcode as a')
            ->leftJoin('address_city as c', 'a.az_city', '=', 'c.city_id')
            ->leftJoin('address_district as d', 'c.district_id', '=', 'd.district_id')
            ->where('az_barangay', 'like', '%' . $searchTerm . '%')
            ->get();

        $city = $request->input('city');

        $citys = City::select('a.az_zipcode', 'c.city_name', 'c.city_id', 'd.*')
            ->from('address_city as c')
            ->leftJoin('aap_zipcode as a', 'c.city_id', '=', 'a.az_city')
            ->leftJoin('address_district as d', 'c.district_id', '=', 'd.district_id')
            ->where('c.city_name', 'like', '%' . $city . '%')
            ->where('a.az_barangay', '')
            ->get();
        
        return view('new_reseller')->with([
            'packages' => ['members' => $members, 'plantype' => $plantype],
            'towns'    => $towns,
            'citys'     => $citys
        ]);
    }
}
