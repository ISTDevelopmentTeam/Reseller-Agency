<?php

namespace App\Traits;
use Illuminate\Support\Facades\Http;

trait Api_connection
{   
    public function Weis_api()
    {
        $response = Http::get(env('WEIS_API_URL_FIRST'));
        if($response->successful()){
            return env('WEIS_API_URL_FIRST');
        }
        return 'http://192.168.0.17/aap_webhook_test';
    }

}
 