<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Town;
use App\Models\City;
use App\Models\Membership;
use App\Models\MembershipType;
use App\Models\PlanType;
use App\Models\PidpDestination;
use App\Traits\Insurance\Get_carmake;
use App\Http\Requests\PidpRequest;
use Illuminate\Support\Facades\Auth;

class PidpController extends Controller
{
    use Get_carmake;

    protected $token;
    private $encryption_key;
    private $encryption_iv;
    public function __construct()
    {
        $this->encryption_key = base64_decode(env('ENCRYPTION_KEY'));
        $this->encryption_iv = base64_decode(env('ENCRYPTION_IV'));
    }

    
    public function encrypt($data) {
        $encrypted = openssl_encrypt($data, 'AES-256-CBC',$this->encryption_key  , OPENSSL_RAW_DATA, $this->encryption_iv);
        return base64_encode($encrypted);
    }

    public function decrypt($data) {
        $decrypted = openssl_decrypt(base64_decode($data), 'AES-256-CBC',$this->encryption_key  , OPENSSL_RAW_DATA, $this->encryption_iv);
        return $decrypted;
    }
    public function index(Request $request, $membershipId, $planId){
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
    
        return view('reseller_form/pidp')->with([
            'towns'              => $towns,
            'citys'              => $citys,
            'carMake'            => $carMake,
            'selectedMembership' => $selectedMembership,
            'selectedPlan'       => $selectedPlan,
            'destinations'       => $destinations
        ]);
    }

    public function store(PidpRequest $request)
    {
        
        // Additional token validation
        if (!$request->session()->token() === $request->input('_token')) {
            abort(403, 'CSRF token mismatch');
        }

        $user = Auth::user();
        $authorized_name = $user->name;
        // dd($authorized_name);

        $request_array = $request->personal_info;
        $license = $request->license_details;

        $request_array["typesofapplication"] = 'NEW';
        $request_array["platform"]           = 'Reseller Platform';
        $request_array["category"]           = 'Reseller';
        $request_array["status"]             = 'PENDING';
        $request_array["application_date"]   = date("Y-m-d");
        $request_array['option']             = 'Authorized';
        $request_array['representative_name'] = $authorized_name;

        if($request->input('personal_info.plantype_id') === '8'){
            $request_array["plan_type"]     = 'ANNUAL FEE (REGULAR)';
            $request_array["pidp_plantype"] = "ANNUAL (PIDP)";
        }
        if($request->input('personal_info.plantype_id') === '9')
        {
            $request_array["plan_type"]     = 'TWO YEAR FEE (REGULAR)';
            $request_array["pidp_plantype"] = "TWO YEARS (PIDP)";
        }

        if($request->input('personal_info.plantype_id') === '10')
        {
            $request_array["plan_type"]     = 'THREE YEAR FEE (REGULAR)';
            $request_array["pidp_plantype"] = "THREE YEARS (PIDP)";
        }

        $no_japan       = $request->input('destinationOut');
        $yes_japan      = $request->input('japan_only');
        $japan_other    = $request->input('destinationIn');
        $purpose_travel = $request->input('purposetravel');
        $is_ofw         = $request->input('ofw');

        
        
        if ($no_japan && $purpose_travel != '') {
            $request_array['members_destination'] = $no_japan;
            $request_array['members_purposetravel'] = $purpose_travel;

            if ($request->has('hereby3')) {
                $checkboxValue1 = $request->input('hereby3');
                $request_array['agreeothrs'] = $checkboxValue1;
            }
        } else if ($japan_other && $purpose_travel != '') {
            $request_array['members_destination2'] = $yes_japan;
            $request_array['members_purposetravel'] = $purpose_travel;
            $request_array['members_destination'] = $japan_other;

            if ($request->has('hereby2')) {
                $checkboxValue2 = $request->input('hereby2');
                $request_array['agreejpn2'] = $checkboxValue2;
            }
        } else {
            $request_array['members_destination2'] = $yes_japan;
            $request_array['members_purposetravel'] = $purpose_travel;

            if ($request->has('hereby1')) {
                $checkboxValue3 = $request->input('hereby1');
                $request_array['agreejpn1'] = $checkboxValue3;
            }
        }
        if (!empty($is_ofw)) {
            $request_array['is_ofw'] = $is_ofw;
        }

        // $request_array['is_aq']   = $request->input('availMagazine');


        if ($request->hasFile('imglicense')) {
            $ImageLicFile = $request->file('imglicense');
            $ImageLicName = 'imglicense' . uniqid() . '.' . $ImageLicFile->getClientOriginalExtension();
            $ImageLicPath = $ImageLicFile->storeAs('img', $ImageLicName, 'public');
            $request_array['imglicense'] = $this->encrypt($ImageLicPath);
        }
        if ($request->hasFile('idpicture')) {
            $idImageFile = $request->file('idpicture');
            $idImageName = 'idpicture_' . uniqid() . '.' . $idImageFile->getClientOriginalExtension();
            $idImagePath = $idImageFile->storeAs('img', $idImageName, 'public');
            $request_array['idpicture'] = $this->encrypt($idImagePath);
        }

        $license_expirationdate = Carbon::createFromFormat('m/d/Y', $request_array['members_licenseexpirationdate'])->format('Y-m-d');
        $request_array['members_licenseexpirationdate'] = $license_expirationdate;

                // DL CODE
                $dlcode = $request->input('dlcodearray');

                if (empty($dlcode)) {
                    $request_array["members_licensedlcode"] = null;
                    $request_array["is_dlcode"] = 1;
                } else {
                    // Split the comma-separated string into an array
                    $restriction_array = explode(',', $dlcode);

                    // Trim whitespace from each element
                    $restriction_array = array_map('trim', $restriction_array);

                    // Convert the array to an indexed array starting from 1
                    $indexed_array = array_combine(range(1, count($restriction_array)), array_values($restriction_array));

                    // Serialize the indexed array
                    $restric_sr = serialize($indexed_array);

                    $request_array["is_dlcode"] = 2;
                    $request_array["members_licensedlcode"] = $restric_sr;
                }
        
                // RESTRICTION
                $restriction = $request->input('restriction');
        
                if($restriction == ''){
                    $request_array["members_licenserest"] = null;
                }else{
                  $restriction = array_combine(range(1, count($restriction)), array_values($restriction));
                   $sr = serialize($restriction);
                   $request_array["members_licenserest"] = $sr;
                //    $array["members_licenserest"] =implode(',', array_values(unserialize($sr)));
                }

                if (!empty($request->input('departure_date1')) && !empty($request->input('return_date1'))) {
                    if (!empty($request->input('departure_date1'))) {
                        $request_array['departure_date'] = Carbon::parse($request->input('departure_date1'))->format('Y-m-d');
                    }
                    if (!empty($request->input('return_date1'))) {
                        $request_array['arrival_date'] = Carbon::parse($request->input('return_date1'))->format('Y-m-d');
                    }
                } else {
                    if (!empty($request->input('departure_date'))) {
                        $request_array['departure_date'] = Carbon::parse($request->input('departure_date'))->format('Y-m-d');
                    }
                    if (!empty($request->input('return_date'))) {
                        $request_array['arrival_date'] = Carbon::parse($request->input('return_date'))->format('Y-m-d');
                    }
                }
        // dd($request_array);

        // ENCRYPTION FOR PERSONAL INFO
        $encrypt_info = [
            'members_title'                  => false,
            'members_licenseexpirationdate'  => false,
            'members_licenseno'              => false,
            'members_lastname'               => false,
            'members_birthdate'              => false,
            'members_emailaddress'           => false,
            'members_alternate_emailaddress' => true,
            'alt_email'                      => true,
            'occupation_name'                => false,
            'members_mobileno'               => false,
            'members_alternate_tel'          => true,
            'members_alternate_mobileno'     => true,
            'tele_num'                       => true,
            'members_haddress1'              => false,
            'members_oaddress1'              => true,
            'representative_name'            => true,
            'representative_contactno'       => true,
            'representative_address'         => true,
            'members_gender'                 => false,
            'members_civilstatus'            => false,
            'citizenship'                    => false,
            'nationality'                    => true,
            'members_birthplace'             => false
        ];   

        foreach($encrypt_info as $field => $is_representative){
            if ($is_representative) {
                // If representative and alt mobile/email field are not empty.
                if (!empty($array[$field])) {
                    $request_array[$field] = $this->encrypt(strip_tags($request_array[$field]));
                }
            } else {
                $request_array[$field] = $this->encrypt(strip_tags($request_array[$field]));
            }
        }
        // dd($request_array);
        $page = Membership::create($request_array);

        $details = [];

        foreach ($request->input('vehicle_plate') as $key => $value) {
            $details[] = [
                'is_cs'        => !empty($request->input('is_cs')[$key]) ? $request->input('is_cs')[$key] : 0,
                'plate'        => !empty($request->input('vehicle_plate')[$key])  ? $this->encrypt($request->input('vehicle_plate')[$key]) : null,
                'make'         => !empty($request->input('vehicle_make')[$key]) ? $request->input('vehicle_make')[$key] : null,
                'model'        => !empty($request->input('vehicle_model')[$key]) ? $request->input('vehicle_model')[$key] : null,
                'year'         => !empty($request->input('vehicle_year')[$key]) ? $request->input('vehicle_year')[$key] : null,
                'color'        => !empty($request->input('vehicle_color')[$key]) ? $request->input('vehicle_color')[$key] : null,
                'fuel'         => !empty($request->input('vehicle_fuel')[$key]) ? $request->input('vehicle_fuel')[$key] : null,
                'transmission' => !empty($request->input('vehicle_transmission')[$key]) ? $request->input('vehicle_transmission')[$key] : null,
                // Handle OR image upload
                'or_image' => $request->hasFile("or_image.{$key}") ?
                $this->encrypt($request->file("or_image.{$key}")->storeAs(
                        'img',
                        'or_' . uniqid() . '.' . $request->file("or_image.{$key}")->getClientOriginalExtension(),
                        'public'
                    )) : null,

                // Handle CR image upload
                'cr_image' => $request->hasFile("cr_image.{$key}") ?
                $this->encrypt($request->file("cr_image.{$key}")->storeAs(
                        'img',
                        'cr_' . uniqid() . '.' . $request->file("cr_image.{$key}")->getClientOriginalExtension(),
                        'public'
                    )) : null,

                'vehicle_type' => !empty($request->input('vehicle_type')[$key]) ? $request->input('vehicle_type')[$key] : null,
                'submodel' => !empty($request->input('submodel')[$key]) ? $request->input('submodel')[$key] : null,
                'is_active' => 1,
                'is_diplomat' => !empty($request->input('is_diplomat')[$key]) ? $request->input('is_diplomat')[$key] : 0,

            ];
        }

        // dd($details);
        $page->vehicles()->createMany($details);


        return redirect()->route('event_dashboard');
     }
}
