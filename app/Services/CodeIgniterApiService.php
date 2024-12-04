<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CodeIgniterApiService
{
    /**
     * Create a new class instance.
     */
    protected $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config('http://insurance_backup.test/');
    }

    public function saveQuotation($data)
    {
        $response = Http::post($this->baseUrl . '/welcome/save_quotation', $data);

        return $response->json();
    }
}
