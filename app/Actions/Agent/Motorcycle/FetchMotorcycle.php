<?php

namespace App\Actions\Agent\Motorcycle;
use App\Models\Town;
use App\Models\City;
use App\Models\PlanType;
use App\Traits\Insurance\Get_carmake;
class FetchMotorcycle
{
    use Get_carmake;
    public function handle($request, $planId)
    {
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
    
        $carMake = json_decode($this->get_carmake(), true);
        
        // Get all plan types
        $planTypes = PlanType::all();
    
        // If a specific plan ID is passed, find that plan
        $selectedPlan = $planId ? PlanType::where('plan_id', $planId)->first() : null;
    
        return [
            'towns'        => $towns,
            'citys'        => $citys,
            'carMake'      => $carMake,
            'planTypes'    => $planTypes,
            'selectedPlan' => $selectedPlan
        ];
    }
}
