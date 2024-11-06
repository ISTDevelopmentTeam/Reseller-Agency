<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportResellerController extends Controller
{
    public function index(){
        return view("report/report_reseller");
    }
}
