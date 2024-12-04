<?php

namespace App\Traits\Insurance;
use App\Traits\Generate_token;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

trait Get_carmake
{
    use Generate_token;

    public function get_carmake()
    {
        try {
            $link = $this->Weis_api(). '/weis/getbrand/';
            $response = Http::withHeaders(['Authorization' => $this->get_token()])->get($link);

            if (!$response->successful()) {
                throw new \Exception("API request failed", $response->status());
            }

            $carmake = $response->json();

            if (empty($carmake) || $carmake['status'] != 201) {
                return [];
            }

            $brands = $carmake['data'];
            $term = strtolower($_GET['term'] ?? '');

            $row_set = array_filter(array_map(function($c) use ($term) {
                if (empty($term) || $this->like($c['brand_name'], $term)) {
                    return [
                        'brand' => htmlspecialchars($c['brand_name'], ENT_QUOTES, 'UTF-8')
                    ];
                }
                return null;
            }, $brands));

            return json_encode(array_values($row_set));

        } catch (\Exception $e) {
            Log::error('Error in get_carmake: ' . $e->getMessage());
            return json_encode(['title' => "Error || " . $e->getCode()]);
        }
    }

    private function like($str, $searchTerm)
    {
        return stripos($str, $searchTerm) !== false;
    }
}