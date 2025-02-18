<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Membership;

class DashboardController extends Controller
{
    protected $token;
    private $encryption_key;
    private $encryption_iv;

    public function __construct()
    {
        $this->encryption_key = base64_decode(env('ENCRYPTION_KEY'));
        $this->encryption_iv = base64_decode(env('ENCRYPTION_IV'));
    }

    public function encrypt($data)
    {
        $encrypted = openssl_encrypt($data, 'AES-256-CBC', $this->encryption_key, OPENSSL_RAW_DATA, $this->encryption_iv);
        return base64_encode($encrypted);
    }

    public function decrypt($data)
    {
        $decrypted = openssl_decrypt(base64_decode($data), 'AES-256-CBC', $this->encryption_key, OPENSSL_RAW_DATA, $this->encryption_iv);
        return $decrypted;
    }

    public function index()
    {
        $members = Membership::all()->map(function ($member) {
            $member->members_lastname = $this->decrypt($member->members_lastname);
            return $member;
        });

        // Statistics calculation remains the same
        $today = now()->format('Y-m-d');
        $startOfMonth = now()->startOfMonth()->format('Y-m-d');
        $startOfWeek = now()->startOfWeek()->format('Y-m-d');

        $todayNewResellers = Membership::whereDate('application_date', $today)
        ->whereIn('typesofapplication', ['NEW', 'RENEW'])
        ->count();

        $monthlyNewResellers = Membership::whereDate('application_date', '>=', $startOfMonth)
            ->where('typesofapplication', 'NEW')
            ->count();

        $weeklyResellers = Membership::whereDate('application_date', '>=', $startOfWeek)
            ->count();

        return view("dashboard", compact(
            'members',
            'todayNewResellers',
            'monthlyNewResellers',
            'weeklyResellers'
        ));
    }
}
