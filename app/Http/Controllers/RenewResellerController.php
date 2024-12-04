<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Actions\Renew\Search_by_pin;
use App\Actions\Renew\Regular_search;
use App\Models\PlanType;
use App\Models\MembershipType;
use App\Models\Town;
use App\Models\City;
use App\Models\Membership;
use App\Traits\Insurance\Get_carmake;
use App\Traits\Member_data;

class RenewResellerController extends Controller
{
    use Get_carmake, Member_data;
    
    protected $Search_by_pin;
    protected $Regular_search;
    protected $token;

    public function __construct(Search_by_pin $Search_by_pin, Regular_search $Regular_search)
    {
        $this->Search_by_pin  = $Search_by_pin;
        $this->Regular_search = $Regular_search;
    }
    public function index(){
        return view("renew_reseller");
    }

    public function search_member(Request $request)
    {
        if ($request->filled('search.pincode')){
            return  $this->Search_by_pin->handle($request);
        }
        return  $this->Regular_search->handle($request);
    }

    // public function renewal_membership(Request $request)
    // {
    //     return  $this->Regular_search->handle($request);      
    // }

    public function reseller_form(Request $request)
    {
        $members  = MembershipType::where('membership_status', 'ACTIVE')->get();
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

        $carMake = json_decode($this->get_carmake(), true);

        // Fetch records based on pincode and record number
        $pincode = $request->segment(4);
        $record_no = $request->segment(5);
        $records = $this->get_member_data($pincode, $record_no);
        
            
        $carMake = json_decode($this->get_carmake(), TRUE);

        //  return dd($records['result_car']);
        $data = [
            'title'        => 'Membership Renewal Form',
            'packages'     => ['members' => $members, 'plantype' => $plantype],
            'towns'        => $towns,
            'citys'        => $citys,
            'records'      => $records,
            'carMake'      => $carMake,
        ];

        // dd($records);

        return view('renew_reseller/renew_form', $data);
 
        
        // return view('renew_reseller/renew_form')->with([
        //     'packages' => ['members' => $members, 'plantype' => $plantype],
        //     'towns'    => $towns,
        //     'citys'     => $citys,
        //     'carMake'=>$carMake
        // ]);
    }

}
