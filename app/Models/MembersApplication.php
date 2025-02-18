<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MemberVehicleModel;

class MembersApplication extends Model
{
    protected $table = 'members_application';
    protected $primaryKey = 'application_id';
    public $timestamps = false;
    
    protected $guarded = [];

    public function vehicles()
    {
        return $this->hasMany(MemberVehicleModel::class, 'application_id', 'application_id');
    }

}
