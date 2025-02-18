<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Membership;

class MemberVehicleModel extends Model
{
    protected $table = 'member_vehicle';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $guarded = [];

    public function vehicle()
    {
        return $this->belongsTo(Membership::class, 'application_id', 'application_id');
    }
}
