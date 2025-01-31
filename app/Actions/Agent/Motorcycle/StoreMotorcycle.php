<?php

namespace App\Actions\Agent\Motorcycle;
use App\Models\Membership;
use Illuminate\Support\Facades\Auth;

class StoreMotorcycle
{
    protected $token;
    private $encryption_key;
    private $encryption_iv;

    public function __construct()
    {
        $this->encryption_key = base64_decode(env('ENCRYPTION_KEY'));
        $this->encryption_iv  = base64_decode(env('ENCRYPTION_IV'));
    }

    public function encrypt($data)
    {
        $encrypted = openssl_encrypt($data, 'AES-256-CBC', $this->encryption_key, OPENSSL_RAW_DATA, $this->encryption_iv);
        return base64_encode($encrypted);
    }

    public function handle($request)
    {
        // Additional token validation
        if (!$request->session()->token() === $request->input('_token')) {
            abort(403, 'CSRF token mismatch');
        }

        $user = Auth::user();
        // dd($authorized_name);

        $request_array = $request->personal_info;

        $request_array["typesofapplication"]  = 'NEW';
        $request_array["platform"]            = 'Reseller Platform';
        $request_array["category"]            = 'Reseller';
        $request_array["status"]              = 'PENDING';
        $request_array["application_date"]    = date("Y-m-d");
        $request_array["membership_type"]     = 'MOTORCYCLE MEMBERSHIP PLUS';
        $request_array['option']              = 'Authorized';
        $request_array['representative_name'] = $user->name;
        $request_array['agent']               = $user->id;

        if ($request->hasFile('idpicture')) {
            $idImageFile                = $request->file('idpicture');
            $idImageName                = 'idpicture_' . uniqid() . '.' . $idImageFile->getClientOriginalExtension();
            $idImagePath                = $idImageFile->storeAs('img', $idImageName, 'public');
            $request_array['idpicture'] = $this->encrypt($idImagePath);
        }

        $encrypt_field = [
            'members_title'                  => false,
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
            'members_birthplace'             => false,
            'nationality'                    => true,
            'insured1'                       => false,
            'beneficiary1'                   => false,
            'relation1'                      => false,
            'bday_insured1'                  => false,
            'insured2'                       => true,
            'beneficiary2'                   => true,
            'relation2'                      => true,
            'bday_insured2'                  => true,
            'insured3'                       => true,
            'beneficiary3'                   => true,
            'relation3'                      => true,
            'bday_insured3'                  => true
        ];

        foreach ($encrypt_field as $field => $is_representative) {
            if ($is_representative) {
                // If representative and alt mobile/email field are not empty.
                if (!empty($request_array[$field])) {
                    $request_array[$field] = $this->encrypt(strip_tags($request_array[$field]));
                }
            } else {
                $request_array[$field] = $this->encrypt(strip_tags($request_array[$field]));
            }
        }

        $page = Membership::create($request_array);

        $details = [];

        foreach ($request->input('vehicle_plate') as $key => $value) {
            $details[] = [
                'is_cs'        => !empty($request->input('is_cs')[$key]) ? $request->input('is_cs')[$key] : 0,
                'plate'        => !empty($request->input('vehicle_plate')[$key]) ? $this->encrypt($request->input('vehicle_plate')[$key]) : null,
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
                'submodel'     => !empty($request->input('submodel')[$key]) ? $request->input('submodel')[$key] : null,
                'is_active'    => 1,
                'is_diplomat'  => !empty($request->input('is_diplomat')[$key]) ? $request->input('is_diplomat')[$key] : 0,

            ];
        }

        $page->vehicles()->createMany($details);


        return redirect()->route('event_dashboard');
    }

}
