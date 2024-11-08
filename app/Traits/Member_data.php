<?php
namespace App\Traits;
use Illuminate\Support\Facades\Http;
use App\Traits\Generate_token ;

trait Member_data
{
    use Generate_token;
    public function __construct()
    {
        $this->token = $this->get_token();
    }

    public function get_member_data($mcode, $record_no)
    {
        $link = $this->Weis_api() . '/weis/fetchmemberinfo/' . $mcode;
        $response1 = Http::withHeaders(['Authorization' => $this->token])->get($link);

        if ($response1->successful()) {
            $members_info = $response1->json();

            if ($members_info['status'] == 201) {
                $details = $members_info['details'];
                $sponsor = 'REGULAR INDIVIDUAL';
                $link2 = $this->Weis_api(). '/weis/fetchmembership/' . $record_no;

                $response2 = Http::withHeaders(['Authorization' => $this->token])->get($link2);
                $members_record = $response2->json();
                if ($members_record['status'] == 201) {
                    $result_record = $members_record['details']['membership'][0];
                    $result_car = $members_record['details']['membership']['vehicles'];
                    $member_data = array('result_info' => $details, 'result_record' => $result_record, 'result_car' => $result_car);
                    return $member_data;
                } else {
                    // Handle error
                  return  $data['title'] = "Error || 210";
                }
            }
        } else {
            // Handle error
            return $data['title'] = "Error || 210";
        }
    }
}