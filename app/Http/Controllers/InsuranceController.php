<?php

namespace App\Http\Controllers;

use App\Services\CodeIgniterApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Http;
use App\Traits\Generate_token ;
use App\Traits\Insurance\Get_carmake;
use App\Traits\Insurance\Get_carmodel;
use App\Traits\Insurance\Get_bodytype;
use App\Traits\Insurance\Get_yearmodel;
use App\Traits\Insurance\Get_submodel;
use App\Traits\Insurance\Get_resultcriteria;
use App\Traits\Insurance\Get_calculatorcriteria;
use App\Traits\Insurance\Get_insurance;
class InsuranceController extends Controller
{
    use Get_carmake,Get_carmodel,Get_bodytype,Get_yearmodel,Get_submodel;
    use Generate_token;
    protected $ciApiService;

    public function __construct(CodeIgniterApiService $ciApiService)
    {
        $this->ciApiService = $ciApiService;
    }

    public function getcarMakeTest(){
        return json_decode($this->get_carmake(), TRUE);
    }

    public function getCarModel(Request $request)
    {
        // return json_decode($this->get_carmodel($request->input('make')));
        return $this->get_carmodel($request->input('make'));
    }

    public function getBodyType(Request $request)
    {
        return json_decode($this->get_BodyType($request->input('model')));
    }

    public function getYearModel(Request $request)
    {
        return json_decode($this->get_yearmodel($request->input('model'),$request->input('vehicle_type')));
    }

    public function getSubModel(Request $request)
    {
        return json_decode($this->get_submodel($request->input('model'),$request->input('year'),$request->input('vehicle_type')));
    }


    
}