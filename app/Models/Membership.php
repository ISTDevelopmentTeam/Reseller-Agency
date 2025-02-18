<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MemberVihicleModel;

class Membership extends Model
{
    // use HasFactory;

    protected $table = "members_application";

    protected $primaryKey = "application_id";

    public $timestamps = false;

    protected $guarded = [];

    public function vehicles()
    {
        return $this->hasMany(MemberVehicleModel::class, 'application_id', 'application_id');
    }
}
