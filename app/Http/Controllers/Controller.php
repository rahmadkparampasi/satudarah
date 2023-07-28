<?php

namespace App\Http\Controllers;

use Detection\MobileDetect;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function setDisplay($methodForm, $dis = '')
    {
        $MethodForm1 = substr($methodForm, 0, 10);
        if ($MethodForm1=="updateData") {
            if ($dis=='') {
                return 'display: flex;';
            }else{
                return 'display: '.$dis.';';
            }
        }else{
            return 'display: none;';
        }
    }

    public function getUser()
    {
        $user = Auth::user(); 

        return $user;
    }

    public function isMobile()
    {
        $detect = new MobileDetect();
        $mobile = false;
        if ($detect->isMobile() || $detect->isTablet()) {
            $mobile = true;
        }

        return $mobile;
    }
}

/*
Testing Nomor

+6282290327479 Ibu Ruhiyah
+6282293612922
+6281241520327
+6282187303986
+6282195956722
+6283152613368
+6285241353015
+6285255511151
+6282214262079 Ibu Femi
+6282271527681 Ibu Diana

*/