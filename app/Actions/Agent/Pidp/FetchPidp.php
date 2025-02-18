<?php

namespace App\Actions\Agent\Pidp;
use App\Models\Town;
use App\Models\City;
use App\Models\MembershipType;
use App\Models\PlanType;
use App\Models\PidpDestination;
use App\Traits\Insurance\Get_carmake;
class FetchPidp
{
    use Get_carmake;
    public function handle($request, $membershipId, $planId)
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

        $destinations = PidpDestination::where('ad_status', '=', 'ACTIVE')
              //->where('ad_name', 'like', '%'.$search.'%')
            ->get();

          // Find the selected membership
        $selectedMembership = MembershipType::where('membership_id', $membershipId)->first();

          // Find the selected plan
        $selectedPlan = PlanType::where('plan_id', $planId)->first();

        return[
            'towns'              => $towns,
            'citys'              => $citys,
            'carMake'            => $carMake,
            'selectedMembership' => $selectedMembership,
            'selectedPlan'       => $selectedPlan,
            'destinations'       => $destinations
        ];
    }
}
