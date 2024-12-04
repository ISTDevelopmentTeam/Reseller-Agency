<?php

namespace App\Traits\Insurance;

use App\Traits\Generate_token;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

trait Get_submodel
{
    use Generate_token;

    public function get_submodel($model, $year,$vehicle_type)
    {
        if (empty($model) || $model === '0') {
            $row_set[] = array(
                'submodel_name' => '',
                'amount' => '',
                'no_of_pass' => ''
                );
            return json_encode($row_set[]);
        }

        try {
            $link = $this->Weis_api() .'/weis/GetYearSubModel/' . $model . '/' . $year . '/' . $vehicle_type;
            $response = Http::withHeaders(['Authorization' => $this->get_token()])
            ->get($link)
            ->throw();

            $submodel = $response->json();

            if (empty($submodel) || $submodel['status'] !== 201) {
                throw new \Exception("Invalid response data", 210);
            }

            $row_set = array_map(function($c) {
                return [
                    'submodel_name' =>htmlspecialchars($c['submodel_name'] ?? '', ENT_QUOTES, 'UTF-8'),
                    'amount' =>htmlspecialchars($c['amount'] ?? '', ENT_QUOTES, 'UTF-8'),
                    'no_of_pass' =>htmlspecialchars($c['no_of_pass'] ?? '', ENT_QUOTES, 'UTF-8'),
                ];
            }, $submodel['data'] ?? []);
            
            return json_encode($row_set);

        } catch (\Exception $e) {
            Log::error('Error in get_yearmodel: ' . $e->getMessage());
            return json_encode(['title' => "Error || " . ($e->getCode() ?: 500)]);
        }
    }
}