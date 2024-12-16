<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MembershipType extends Model
{
    protected $table = 'membership_type';

    public function planTypes()
    {
        return $this->hasMany(PlanType::class, 'membership_id', 'id');
    }
}
