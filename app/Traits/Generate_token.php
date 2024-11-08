<?php

namespace App\Traits;
use Illuminate\Support\Facades\Http;
use App\Traits\Api_connection;

trait Generate_token
{
    use Api_connection;
 
    public function get_token()
    {
        $response = Http::withHeaders([
                'Content-Type' => 'application/json'
            ])->post($this->Weis_api(). "/weis/generatetoken", [
                'username' => env('API_USERNAME'),
                'password' => env('API_PASSWORD')
            ]);
            return $response->json('token');

    }
}
