<?php

use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;

if (!function_exists('trimString')) {
    function trimString($string) {
        $words = explode(' ', $string);
        $limit = 4;
        $replace = '....';
        $string = count($words) > $limit ? implode(' ', array_slice($words, 0, $limit)) . $replace : $string;
        return $string;
    }
}

if (!function_exists('encrypt')) {
    function encrypt($value) {
      return Crypt::encrypt($value);

    }
}

if (!function_exists(function: 'timeMachine')) {
    function timeMachine() {
     return Carbon::setLocale('id');
    }
}


if (!function_exists(function: 'strCut')) {
    function strCut($string){
        return substr($string, 6);
    }
}











