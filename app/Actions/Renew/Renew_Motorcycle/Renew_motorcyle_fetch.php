<?php

namespace App\Actions\Renew\Renew_Motorcycle;
use App\Models\Town;
use App\Models\City;
use App\Models\PlanType;
use App\Models\MembershipType;
use App\Traits\Member_data;
use App\Traits\Generate_token;

class Renew_motorcyle_fetch
{
    use Generate_token,Member_data;
    protected $token;
    public function __construct()
    {
        $this->token = $this->get_token();
    }
    public function handle($request)
    {
        $packages = PlanType::where('membership_id', 6)->get();   
        $membership = MembershipType::whereIn('membership_id', [6])->get();

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

            $pincode = $request->segment(2);
            $record_no = $request->segment(3);

            $records = $this->get_member_data($pincode, $record_no);
            
            return [
                'title'      => 'Membership Renewal Form',
                'packages'   => $packages,
                'membership' => $membership,
                'towns'      => $towns,
                'citys'      => $citys,
                'records'    => $records
            ];
    }
}
