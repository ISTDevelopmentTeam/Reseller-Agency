<?php

namespace App\Traits;

trait Generate_tracking_no
{
  public function generateApplicationId()
    {
        $year = date('Y');
        $month = date('m');
        $random = mt_rand(1000, 9999);
        return "APP-{$year}{$month}-{$random}";
    }

    public function generateTrackingNumber()
    {
        $prefix = 'TRK';
        $timestamp = time();
        $random = mt_rand(100, 999);
        return "{$prefix}-{$timestamp}-{$random}";
    }

}
