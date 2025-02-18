<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class TokenModel extends Model
{
    use HasFactory;

    // Specify the table name if it doesn't follow Laravel's naming convention
    protected $table = 'temporary_tokens';

    // Specify the fields that can be mass-assigned
    protected $fillable = [
        'token',
        'expires_at',
        'used',
        'form_completed',
        'form_type',
        'agent_id'
    ];

    // Optional: Indicate which fields are dates (to automatically convert to Carbon instances)
    protected $dates = [
        'expires_at',
    ];
}
