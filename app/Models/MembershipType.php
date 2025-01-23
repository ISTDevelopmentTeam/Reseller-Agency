<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MembershipType extends Model
{
    protected $table = 'membership_type';
    protected $primaryKey = 'membership_id'; // Make sure this matches your DB column

    public function planTypes()
    {
        return $this->hasMany(PlanType::class, 'membership_id', 'membership_id');
    }
}
