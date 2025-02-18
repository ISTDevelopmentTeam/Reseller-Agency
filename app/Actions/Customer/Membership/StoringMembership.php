<?php

namespace App\Actions\Customer\Membership;
use App\Models\Membership;
use Illuminate\Support\Facades\Auth;
use App\Models\TokenModel;
use Illuminate\Support\Facades\DB;
use App\Traits\Generate_tracking_no;

class StoringMembership
{
    use Generate_tracking_no;
    protected $token;
    private $encryption_key;
    private $encryption_iv;
    

    public function __construct()
    {
        $this->encryption_key = base64_decode(env('ENCRYPTION_KEY'));
        $this->encryption_iv = base64_decode(env('ENCRYPTION_IV'));
    }

    public function encrypt($data)
    {
        $encrypted = openssl_encrypt($data, 'AES-256-CBC', $this->encryption_key, OPENSSL_RAW_DATA, $this->encryption_iv);
        return base64_encode($encrypted);
    }
    

    public function handle($request, $token)
    {
        return DB::transaction(function () use ($request, $token) {
            // Lock the token record for update and check validity
            $temporaryToken = TokenModel::where('token', $token)
                ->where('form_completed', false)  // Only check if form is not completed
                ->where('form_type', 'membership')  // Must be membership form
                ->lockForUpdate()
                ->first();

            if (!$temporaryToken || $temporaryToken->expires_at < now()) {
                return false;
            }

            // Generate unique application ID and tracking number
            $applicationId = 'APP-' . date('Ym') . '-' . mt_rand(1000, 9999);
            $trackingNumber = 'TRK-' . time() . '-' . mt_rand(100, 999);


            $request_array = $request->personal_info;

            // Add application tracking details
            $request_array["application_track_no"] = $applicationId;
            $request_array["tracking_num"] = $trackingNumber;

            $request_array["typesofapplication"] = 'NEW';
            $request_array["platform"]           = 'Agency Platform';
            $request_array["category"]           = 'Agency';
            $request_array["status"]             = 'PENDING';
            $request_array["application_date"]   = date("Y-m-d");
            $request_array['option']             = 'Personal';
            $request_array['agent']              = $temporaryToken->agent_id;

            // dd($request_array['agent']);

            if ($request->hasFile('idpicture')) {
                $idImageFile = $request->file('idpicture');
                $idImageName = 'idpicture_' . uniqid() . '.' . $idImageFile->getClientOriginalExtension();
                $idImagePath = $idImageFile->storeAs('img', $idImageName, 'public');
                $request_array['idpicture'] = $this->encrypt($idImagePath);
            }


            $encrypt_field = [
                'members_title'                  => true,
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
                'nationality'                    => true,
                'members_gender'                 => false,
                'members_civilstatus'            => false,
                'citizenship'                    => false,
                'members_birthplace'             => false
            ];


            foreach ($encrypt_field as $field => $is_representative) {

                if ($is_representative) {
                    // If representative and alt mobile/email field are not empty.
                    if (!empty($request_array[$field])) {
                        $request_array[$field] = $this->encrypt(strip_tags($request_array[$field]));
                    }
                } else {
                    //   return dd($request_array['members_title']);
                    $request_array[$field] = $this->encrypt(strip_tags($request_array[$field]));

                }
            }



            // dd($request_array);
            $page = Membership::create($request_array);

            // Process vehicle details
            $details = [];
            foreach ($request->input('vehicle_plate') as $key => $value) {
                $details[] = [
                    'is_cs' => !empty($request->input('is_cs')[$key]) ? $request->input('is_cs')[$key] : 0,
                    'plate' => !empty($request->input('vehicle_plate')[$key]) ? $this->encrypt($request->input('vehicle_plate')[$key]) : null,
                    'make' => !empty($request->input('vehicle_make')[$key]) ? $request->input('vehicle_make')[$key] : null,
                    'model' => !empty($request->input('vehicle_model')[$key]) ? $request->input('vehicle_model')[$key] : null,
                    'year' => !empty($request->input('vehicle_year')[$key]) ? $request->input('vehicle_year')[$key] : null,
                    'color' => !empty($request->input('vehicle_color')[$key]) ? $request->input('vehicle_color')[$key] : null,
                    'fuel' => !empty($request->input('vehicle_fuel')[$key]) ? $request->input('vehicle_fuel')[$key] : null,
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

            // Create vehicle records
            $page->vehicles()->createMany($details);

            // Mark token as completed
            $temporaryToken->form_completed = true;
            $temporaryToken->save();

            // Store application ID and tracking number in the session securely
            session([
                'application_id' => $this->encrypt($applicationId),
                'tracking_number' => $this->encrypt($trackingNumber)
            ]);
    
            // Remove the session token
            session()->forget('form_token_' . $token);

    
            return true;
        });
    }

}
