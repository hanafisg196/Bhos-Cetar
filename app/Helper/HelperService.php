<?php

use Illuminate\Support\Facades\Crypt;

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
    function trimString($value) {
      return Crypt::encrypt($value);

    }
}



