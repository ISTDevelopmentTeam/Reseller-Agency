<?php

namespace App\Actions\Renew;
use Illuminate\Support\Facades\Http;
use App\Traits\Member_data;
use App\Traits\Generate_token;

class Search_by_pin
{
    use Generate_token, Member_data;

    protected $token;

    public function __construct()
    {
        $this->token = $this->get_token();
    }

    public function handle($request){
        $searchParams = $request->input('search');
        $searchPin = strtoupper($searchParams['pincode'] ?? null);
        dd($searchPin);
        $link = $this->Weis_api() . '/weis/fetchmemberinfo/' . $searchPin;

        $response1 = Http::withHeaders(['Authorization' => $this->token])->get($link);

        if ($response1->successful()) {
            $members_info = $response1->json();
            if (isset($members_info['details'])) {
                $data['details'] = $members_info['details'];
                $members_id = $members_info['details'][0]['members_id'];
                $mcode = $members_info['details'][0]['members_pincode'];
                $lname = $members_info['details'][0]['members_lastname'];
                $fname = $members_info['details'][0]['members_firstname'];

                $link2 = $this->Weis_api() . '/weis/fetchbulkmemberships/' . $mcode;

                $response2 = Http::withHeaders(['Authorization' => $this->token])->get($link2);
                $members_record = $response2->json();

                foreach ($members_record['details'] as $row) {
                    $record = $row['vehicleinfohead_id'];
                    $record_no = $row['vehicleinfohead_order'];
                    $vehicleinfohead_activedate = $row['vehicleinfohead_activedate'];
                    $vehicleinfohead_expiredate = $row['vehicleinfohead_expiredate'];
                    $vehicleinfohead_status = $row['vehicleinfohead_status'];
                    $sponsor_name = $row['sponsor_name'];

                    $link3 = $this->Weis_api() . '/weis/fetchmembership/' . $record;
                    $response3 = Http::withHeaders(['Authorization' => $this->token])->get($link3);

                    $result = $response3->json();
                    $car_det = array();

                    if (isset($result['details']['membership']['vehicles'])) {
                        foreach ($result['details']['membership']['vehicles'] as $car) {
                            $plate = $car['vehicleinfo_plateno'];
                            $make = $car['vehiclebrand_name'];
                            $model = $car['vehiclemodel_name'];
                            $car_det[] =  $plate . ' - ' . $make . ' ' . $model;
                        }
                    }
                    $details = array(
                        'members_id' => $mcode,
                        'vehicleinfohead_id' => $record,
                        'members_lastname' =>  $lname,
                        'members_firstname' => $fname,
                        'vehicleinfohead_order' => $record_no,
                        'vehicleinfohead_activedate' => $vehicleinfohead_activedate,
                        'vehicleinfohead_expiredate' => $vehicleinfohead_expiredate,
                        'vehicleinfohead_status' => $vehicleinfohead_status,
                        'sponsor_name' => $sponsor_name,
                        'car_details' => $car_det,
                    );

                    $membership_info[] = $details;

                    $this->get_member_data($mcode, $record);

                }
            } else {
                // If 'details' key is not present, return no records found
                return view('renew_reseller')->with('membership_info', []);
            }
        }
        if (empty($membership_info)) {
            return view('renew_reseller')->with('membership_info', []);
        }

        return view('renew_reseller', compact('membership_info'));
    }
}