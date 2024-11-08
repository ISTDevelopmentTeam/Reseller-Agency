<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionDetailsModel extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'membership_plantype';

    // Define the columns that can be mass-assigned
    protected $fillable = 
    [
        'plan_id',
        'plantype_id', 
        'plan_name', 
        'plan_amount', 
        'membership_id',
        'plan_status', 
        'added_by', 
        'added_when', 
        'update_by', 
        'update_when', 
        'remarks' 

    ];
}
