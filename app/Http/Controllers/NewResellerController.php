<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewResellerController extends Controller
{
    public function index(){
        return view("new_reseller");
    }
}
