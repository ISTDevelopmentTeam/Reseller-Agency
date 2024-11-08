<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Town extends Model
{
    protected $table = 'aap_zipcode';
    protected $primaryKey = 'az_id';

    public function city()
    {
        return $this->belongsTo(City::class,'az_city', 'city_id' );
    }
}
