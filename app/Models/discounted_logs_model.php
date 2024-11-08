<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class discounted_logs_model extends Model
{
    protected $table = 'membership_discount';

    public $timestamps = false;

    // Define the columns that can be mass-assigned
    protected $fillable = 
    [
        'discount_id',
        'plan_id', 
        'discount_amount', 
        'discount_start', 
        'discount_end',
        'added_by', 
        'added_when', 
    ];
}
