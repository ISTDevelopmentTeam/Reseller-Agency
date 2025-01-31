<?php

namespace App\Actions\Customer\Membership;
use App\Models\Town;
use App\Models\City;
use App\Models\MembershipType;
use App\Models\TokenModel;
use App\Models\PlanType;
use App\Traits\Insurance\Get_carmake;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class CustomerMembership
{
    use Get_carmake;
    public function handle($request, $membershipId, $planId, $token)
    {
        // Use transaction to ensure data consistency
        return DB::transaction(function () use ($request, $membershipId, $planId, $token) {
            // Lock the token record for update
            $temporaryToken = TokenModel::where('token', $token)
                ->lockForUpdate()
                ->first();

            // Check if token exists, is expired, or has been completed
            if (!$temporaryToken || 
                $temporaryToken->expires_at < now() || 
                $temporaryToken->form_completed) {  // Check if form was completed
                return false;
            }

            $searchTerm = $request->input('town');
            $city = $request->input('city');

            $towns = Town::select('a.*', 'c.*', 'd.*')
                ->from('aap_zipcode as a')
                ->leftJoin('address_city as c', 'a.az_city', '=', 'c.city_id')
                ->leftJoin('address_district as d', 'c.district_id', '=', 'd.district_id')
                ->where('az_barangay', 'like', '%' . $searchTerm . '%')
                ->get();

            $citys = City::select('a.az_zipcode', 'c.city_name', 'c.city_id', 'd.*')
                ->from('address_city as c')
                ->leftJoin('aap_zipcode as a', 'c.city_id', '=', 'a.az_city')
                ->leftJoin('address_district as d', 'c.district_id', '=', 'd.district_id')
                ->where('c.city_name', 'like', '%' . $city . '%')
                ->where('a.az_barangay', '')
                ->get();

            //     $user = Auth::user();
            // dd($user);

            return [
                'towns' => $towns,
                'citys' => $citys,
                'carMake' => json_decode($this->get_carmake(), true),
                'selectedMembership' => MembershipType::where('membership_id', $membershipId)->first(),
                'selectedPlan' => PlanType::where('plan_id', $planId)->first(),
                'token' => $token
            ];
        });
    }
}
