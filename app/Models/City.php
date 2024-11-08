<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'address_city';
    protected $primaryKey = 'city_id';

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id', 'district_id');
    }
}
