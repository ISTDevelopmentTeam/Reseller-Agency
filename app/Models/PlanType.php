<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanType extends Model
{
    protected $table = 'membership_plantype';

    public function membershipType()
    {
        return $this->belongsTo(MembershipType::class, 'membership_id', 'membership_id');
    }
}
