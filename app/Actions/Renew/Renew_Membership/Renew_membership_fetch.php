<?php

namespace App\Actions\Renew\Renew_Membership;

use App\Models\Town;
use App\Models\City;
use App\Models\MembershipType;
use App\Models\PlanType;
use App\Traits\Member_data;
use App\Traits\Insurance\Get_carmake;

class Renew_membership_fetch
{
    use Get_carmake, Member_data;

    public function handle(object $request)
    {
        $membership = MembershipType::whereIn('membership_id', [1, 2, 4, 5])->get();
        $packages = PlanType::whereIn('membership_id', [1, 2, 4, 5])->get();

        $searchTerm = $request->input('town');
        $city = $request->input('city');

        $towns = Town::select('a.*', 'c.*', 'd.*')
            ->from('aap_zipcode as a')
            ->leftJoin('address_city as c', 'a.az_city', '=', 'c.city_id')
            ->leftJoin('address_district as d', 'c.district_id', '=', 'd.district_id')
            ->where('az_barangay', 'like', '%' . $searchTerm . '%')
            ->get();

        $citys = City::select('a.az_zipcode', 'c.city_name', 'c.city_id', 'd.*')
            ->from('address_city as c')
            ->leftJoin('aap_zipcode as a', 'c.city_id', '=', 'a.az_city')
            ->leftJoin('address_district as d', 'c.district_id', '=', 'd.district_id')
            ->where('c.city_name', 'like', '%' . $city . '%')
            ->where('a.az_barangay', '')
            ->get();

        $pincode   = $request->segment(2);
        $record_no = $request->segment(3);
        $records   = $this->get_member_data($pincode, $record_no);
        // dd($records);

        $carMake = json_decode($this->get_carmake(), true);
        // dd($records);

        return [
            'title'      => 'Membership Renewal Form',
            'membership' => $membership,
            'packages'   => $packages,
            'towns'      => $towns,
            'citys'      => $citys,
            'records'    => $records,
            'carMake'    => $carMake,
        ];
    }
}
