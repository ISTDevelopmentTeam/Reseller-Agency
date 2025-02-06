<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Actions\Renew\Search_by_pin;
use App\Actions\Renew\Regular_search;
use App\Actions\Renew\Renew_Membership\Renew_membership_fetch;
use App\Actions\Renew\Renew_Membership\Renew_membership_store;
use App\Models\PlanType;
use App\Models\MembershipType;
use App\Models\Town;
use App\Models\City;
use App\Models\Membership;
use App\Traits\Insurance\Get_carmake;
use App\Traits\Member_data;
use App\Traits\Generate_token;

class RenewResellerController extends Controller
{
    use Generate_token;
    use Get_carmake, Member_data;
    
    protected $Search_by_pin;
    protected $Regular_search;
    protected $renew_membership_fetch;
    protected $renew_membership_store;
    public $Result_record;

    public function __construct(Search_by_pin $Search_by_pin, Regular_search $Regular_search,
    Renew_membership_fetch $renew_membership_fetch, Renew_membership_store $renew_membership_store)
    {
        $this->Search_by_pin          = $Search_by_pin;
        $this->Regular_search         = $Regular_search;
        $this->renew_membership_fetch = $renew_membership_fetch;
        $this->renew_membership_store = $renew_membership_store;
        $this->Result_record = [];
    }
    public function index(){
        return view("renew_form/renew_reseller");
    }

    public function search_member(Request $request)
    {
        if ($request->filled('search.pincode')){
            return  $this->Search_by_pin->handle($request);
        }
        return  $this->Regular_search->handle($request);
    }

    // public function renewal_membership(Request $request)
    // {
    //     return  $this->Regular_search->handle($request);      
    // }
    public function membership(Request $request)
    {
        $data = $this->renew_membership_fetch->handle($request);
        return view('renew_form/renew_membership')->with($data);
    }
    public function motorcycle(Request $request)
    {
        $data = $this->renew_membership_fetch->handle($request);
        return view('renew_form/motorcycle
        ')->with($data);
    }
    public function pidp(Request $request)
    {
        $data = $this->renew_membership_fetch->handle($request);
        return view('renew_form/renew_pidp')->with($data);
    }

    public function store(Request $request)
    {
        if (!$request->session()->token() === $request->input('_token')) {
            abort(403, 'CSRF token mismatch');
        }

        $this->renew_membership_store->handle($request);
        return redirect()->route('event_dashboard');
    }

}
