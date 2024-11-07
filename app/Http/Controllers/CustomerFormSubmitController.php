<?php

namespace App\Http\Controllers;

use App\Models\CustomerFillOutModel;
use Illuminate\Http\Request;

class CustomerFormSubmitController extends Controller
{
    public function store(Request $request)
    {
      //  return dd($request);
        
        // Validate the incoming data (optional but recommended)
        // $validated = $request->validate([
        //     'email' => 'required|max:255',
        // ]);

        // Use the model to create a new record in the database
        CustomerFillOutModel::create([
            'full_name'     => $request->input('full_name'),
            'password'      => $request->input('password'),
            'email'         => $request->input('email_address'),
            'phone_number'  => $request->input('phone_number'),
        ]);

    // Redirect with a success message
    return redirect()->back()->with('success', 'Customer added successfully!');

    }

}
