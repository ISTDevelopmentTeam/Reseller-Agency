<?php

namespace App\Traits\Insurance;

use App\Traits\Generate_token;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

trait Get_carmodel
{
    use Generate_token;

    public function get_carmodel($make)
{
    try {
        $link = $this->Weis_api() . '/weis/getmodel/' . urlencode($make);
        $response = Http::withHeaders(['Authorization' => $this->get_token()])->get($link);

        if ($response->successful()) {
            $carmodel = $response->json();
            $row_set = array_map(function($c) {
                return [
                    'model' => htmlspecialchars($c['model_name'], ENT_QUOTES, 'UTF-8')
                ];
            }, $carmodel['data']);
            return $row_set;
        } else {
            $errorMessage = 'API request failed with status code ' . $response->status();
            if ($response->json('message')) {
                $errorMessage .= ': ' . $response->json('message');
            }
            Log::error('Error in get_carmodel: ' . $errorMessage);
            return ['error' => $errorMessage];
        }
    } catch (\Exception $e) {
        $errorMessage = 'An error occurred while fetching car models: ' . $e->getMessage();
        Log::error($errorMessage);
        return ['error' => $errorMessage];
    }
}
}