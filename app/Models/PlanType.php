<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanType extends Model
{
    protected $table = 'membership_plantype';
    protected $primaryKey = 'plan_id'; // Make sure this matches your DB column

    public function membershipType()
    {
        return $this->belongsTo(MembershipType::class, 'membership_id', 'membership_id');
    }
}
