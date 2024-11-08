<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Actions\Renew\Search_by_pin;
use App\Actions\Renew\Regular_search;

class RenewResellerController extends Controller
{
    protected $Search_by_pin;
    protected $Regular_search;

    public function __construct(Search_by_pin $Search_by_pin, Regular_search $Regular_search)
    {
        $this->Search_by_pin  = $Search_by_pin;
        $this->Regular_search = $Regular_search;
    }
    public function index(){
        return view("renew_reseller");
    }

    public function search_member(Request $request)
    {
        if ($request->filled('search.pincode')){
            return  $this->Search_by_pin->handle($request);
        }
        return  $this->Regular_search->handle($request);
    }

    public function renewal_membership(Request $request)
    {
        // return  $this->Regular_search->handle($request);      
    }
}
