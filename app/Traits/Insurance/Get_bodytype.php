<?php

namespace App\Traits\Insurance;

use App\Traits\Generate_token;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

trait Get_bodytype 
{
    use Generate_token;
    
    public function get_bodytype($model)
    {
        // Sanitize and validate the model parameter
        if (!is_string($model)) {
            throw new \InvalidArgumentException('Model must be a string');
        }
        
        // Remove any potentially dangerous characters
        $model = preg_replace('/[^a-zA-Z0-9\s-]/', '', $model);
        
        // URL encode the entire string properly
        $model = urlencode($model);
        
        $link = $this->Weis_api() . '/weis/getbodytype/' . $model;
        
        try {
            $response = Http::withHeaders([
                'Authorization' => $this->get_token()
            ])->get($link);
            
            $bodyTypes = $response->json('data', []);
            
            if (empty($bodyTypes)) {
                $link = $this->Weis_api(). '/weis/getbodytype/';
                $response = Http::withHeaders([
                    'Authorization' => $this->get_token()
                ])->get($link);
                $bodyTypes = $response->json('data', []);
            }
            
            $rowsets = array_map(function ($bodyType) {
                return [
                    'bodytype_name' => htmlspecialchars(
                        trim($bodyType['bodytype_name'] ?? ''),
                        ENT_QUOTES,
                        'UTF-8'
                    )
                ];
            }, $bodyTypes);
            
            return json_encode($rowsets, JSON_THROW_ON_ERROR);
            
        } catch (\Exception $e) {
            Log::error('Error fetching body type: ' . $e->getMessage(), [
                'model' => $model,
                'trace' => $e->getTraceAsString()
            ]);
            
            return json_encode([
                'error' => 'An error occurred while processing the request',
                'code' => $e->getCode()
            ]);
        }
    }
}