<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MembershipTypeModal extends Model
{
    protected $table = 'membership_type';
    public $timestamps = false;

    // Define the columns that can be mass-assigned
    protected $fillable = 
    [
        'membership_id',
        'sponsor_id', 
        'membership_name', 
        'membership_code', 
        'vechile_num',
        'membership_status', 
        'added_by', 
        'added_when', 
        'update_by', 
        'update_when'

    ];

}
