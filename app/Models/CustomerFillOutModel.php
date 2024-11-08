<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerFillOutModel extends Model
{
    use HasFactory;

    protected $table = 'customer_input_data';

    // Define the columns that can be mass-assigned
    protected $fillable = ['full_name', 'email', 'password', 'phone_number'];
}
