<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoginCredentialsModel extends Model
{
    protected $table = 'users';

    public $timestamps = false;

    // Define the columns that can be mass-assigned
    protected $fillable = 
    [
        'username',
        'password'  
    ];
}
