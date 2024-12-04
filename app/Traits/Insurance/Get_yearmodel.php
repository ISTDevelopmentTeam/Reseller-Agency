<?php

namespace App\Traits\Insurance;

use App\Traits\Generate_token;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

trait Get_yearmodel
{
    use Generate_token;

    public function get_yearmodel($model, $vehicle_type)
    {
        if (empty($model) || $model === '0') {
            return json_encode([['year' => '']]);
        }

        try {
            $link = $this->Weis_api() . '/weis/GetYearMatrix/' . urlencode($model) . '/' . urlencode($vehicle_type);
            $response = Http::withHeaders(['Authorization' => $this->get_token()])
            ->get($link)
            ->throw();

            $yearmodel = $response->json();

            if (empty($yearmodel) || $yearmodel['status'] !== 201) {
                throw new \Exception("Invalid response data", 210);
            }
            $row_set = [];
            $row_set = array_map(function($c) {
                return ['year' => htmlspecialchars($c['year'] ?? '', ENT_QUOTES, 'UTF-8')];
            }, $yearmodel['data'] ?? []);
            
            return json_encode($row_set);

        } catch (\Exception $e) {
            Log::error('Error in get_yearmodel: ' . $e->getMessage());
            return json_encode(['error' => "Error: " . ($e->getCode() ?: 500)]);
        }
    }
}