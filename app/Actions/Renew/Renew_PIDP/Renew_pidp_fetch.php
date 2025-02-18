<?php

namespace App\Actions\Renew\Renew_PIDP;

use App\Models\PlanType;
use App\Traits\Member_data;
use App\Models\MembershipType;
use App\Models\Town;
use App\Models\City;
use App\Models\PidpDestination;
use App\Traits\Insurance\Get_carmake;
use App\Traits\Generate_token;

class Renew_pidp_fetch
{
    use Generate_token,Member_data,Get_carmake;
    protected $token;
    public function __construct()
    {
        $this->token = $this->get_token();
    }
    
    public function handle($request){

        $membership = MembershipType::whereIn('membership_id', [3])->get();
        $members = PlanType::where('membership_id', 3)->get();

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

        $destinations = PidpDestination::where('ad_status', '=', 'ACTIVE')
        ->get();

        $pincode = $request->segment(2);
        $record_no = $request->segment(3);

        $records = $this->get_member_data($pincode, $record_no);
        $carMake = json_decode($this->get_carmake(), TRUE);

        // dd($records);

        $data = [
            'title'        => 'Membership Renewal Form',
            'membership'   => $membership,
            'members'      => $members,
            'towns'        => $towns,
            'citys'        => $citys,
            'destinations' => $destinations,
            'records'      => $records,
            'card'         => ['CARD', 'NON-CARD'],
            'lictype'      => ['PROFESSIONAL', 'NON PROFESSIONAL'],
            'carMake'      => $carMake,
        ];

        return view('renew_form/renew_pidp')->with($data);

    }

}
