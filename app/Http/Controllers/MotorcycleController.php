<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Town;
use App\Models\City;
use App\Models\Membership;
use App\Models\PlanType;
use App\Models\Vehicle;
use App\Traits\Insurance\Get_carmake;

class MotorcycleController extends Controller
{
    use Get_carmake;
    public function index(Request $request, $planId = null){
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
    
        return view('reseller_form/motorcycle')->with([
            'towns'   => $towns,
            'citys'   => $citys,
            'carMake' => $carMake,
            'planTypes' => $planTypes,
            'selectedPlan' => $selectedPlan
        ]);
    }

    public function store(Request $request){
        $request_array = $request->personal_info;

        $request_array["typesofapplication"] = 'NEW';
        $request_array["platform"]           = 'Reseller';
        $request_array["category"]           = 'KIOSK';
        $request_array["status"]             = 'PENDING';
        $request_array["application_date"]   = date("Y-m-d");

        
        // dd($request->all());
        // Generate random filenames for images
    if ($request->hasFile('orcr_image')) {
        $orcrImageFile = $request->file('orcr_image');
        $orcrImageName = 'orcr_' . uniqid() . '.' . $orcrImageFile->getClientOriginalExtension();
        $orcrImagePath = $orcrImageFile->storeAs('memberships', $orcrImageName, 'public');
        $request_array['orcr_image'] = $orcrImagePath;
    }

    if ($request->hasFile('idpicture')) {
        $idImageFile = $request->file('idpicture');
        $idImageName = 'id_' . uniqid() . '.' . $idImageFile->getClientOriginalExtension();
        $idImagePath = $idImageFile->storeAs('memberships', $idImageName, 'public');
        $request_array['idpicture'] = $idImagePath;
    }

    // dd($request_array);
        $page = Membership::create($request_array);


        $details = [];
       
        foreach ($request->input('vehicle_plate') as $key => $value) {
            $details[] = [
                'is_cs'        => !empty($request->input('is_cs')[$key])  ?  $request->input('is_cs')[$key] : 0,
                'plate'        => !empty($request->input('vehicle_plate')[$key]),
                'make'         => !empty($request->input('vehicle_make')[$key]) ? $request->input('vehicle_make')[$key] : null,
                'model'        => !empty($request->input('vehicle_model')[$key]) ? $request->input('vehicle_model')[$key] : null,
                'year'         => !empty($request->input('vehicle_year')[$key]) ? $request->input('vehicle_year')[$key] : null,
                'color'        => !empty($request->input('vehicle_color')[$key]) ? $request->input('vehicle_color')[$key] : null,
                'fuel'         => !empty($request->input('vehicle_fuel')[$key]) ? $request->input('vehicle_fuel')[$key] : null,
                'transmission' => !empty($request->input('vehicle_transmission')[$key]) ? $request->input('vehicle_transmission')[$key] : null,
                'or_image'     => null,
                'cr_image'     => null,

                
                'vehicle_type'   => !empty($request->input('vehicle_type')[$key]) ? $request->input('vehicle_type')[$key] : null,
                'submodel'       => !empty($request->input('submodel')[$key]) ? $request->input('submodel')[$key] : null,
                'no_of_pass'     => !empty($request->input('no_of_pass')[$key]) ? $request->input('no_of_pass')[$key] : null,
                'amount'         => !empty($request->input('amount')[$key]) ? $request->input('amount')[$key] : 0,
                'acts_of_nature' => !empty($request->input('acts_of_nature')[$key]) ? $request->input('acts_of_nature')[$key] : null,
                'mortgaged'      => !empty($request->input('mortgaged')[$key]) ? $request->input('mortgaged')[$key] : null,
                'bank_id'        => !empty($request->input('bank')[$key]) ? $request->input('bank')[$key] : null,
                'is_active'      => 1,

                'is_diplomat' => !empty($request->input('is_diplomat')[$key]) ? $request->input('is_diplomat')[$key] : 0,
            

            ];
        }

        $page->vehicles()->createMany($details);

        
        return redirect()->route('new_reseller.index');
     }
}
