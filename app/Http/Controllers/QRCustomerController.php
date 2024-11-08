<?php
namespace App\Http\Controllers;
use App\Models\TokenModel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;


class QRCustomerController extends Controller
{
    public function index(){


 // Generate a unique token
 $token = Str::random(40);
   
 // Define the expiration time (1 Day for testing)
 $expiresAt = Carbon::now()->addDay();

 // Save the token to the database
 TokenModel::create([
   'token' => $token,
   'expires_at' => $expiresAt,
]);

// Create the URL with the token
$url = route('customer_fillout_form', ['token' => $token]);

// Include the QRcode library
require_once app_path('Libraries/phpqrcode/qrlib.php');

// Start output buffering
ob_start();

// Generate the QR code and output it to the buffer
\QRcode::png($url, null, QR_ECLEVEL_L, 4); // QR_ECLEVEL_L is for low error correction

// Get the image data from the buffer
$imageData = ob_get_contents();

// Clean (erase) the output buffer and turn off output buffering
ob_end_clean();



// Return the image data as a response with the correct content type
return view('customer_qr', [
    'url'   => $url,
    'imageData' => $imageData,
]);


    }


    // public function generateQRCode()
    // {
            
           
           
    //    }
   


}
