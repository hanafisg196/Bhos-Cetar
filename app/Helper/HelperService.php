<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

if (!function_exists('trimString')) {
    function trimString($string)
    {
        $words = explode(' ', $string);
        $limit = 4;
        $replace = '....';
        $string = count($words) > $limit ? implode(' ', array_slice($words, 0, $limit)) . $replace : $string;
        return $string;
    }
}

if (!function_exists('cutLink')) {
   function cutLink($word)
   {
     $limit = 40;
     $replace = '....';

     if (strlen($word) > $limit) {
       $limitWord =  substr($word, 0, $limit) . $replace ;
     } else {
      return $word;
     }
     return $limitWord;
   }
}


if (!function_exists('trimName')) {
    function trimName($string)
    {
        $words = explode(' ', $string);
        $limit = 2;
        $replace = '....';
        $string = count($words) > $limit ? implode(' ', array_slice($words, 0, $limit)) . $replace : $string;
        return $string;
    }
}

if (!function_exists('encrypt')) {
    function encrypt($value)
    {
        return Crypt::encrypt($value);
    }
}

if (!function_exists(function: 'timeMachine')) {
    function timeMachine()
    {
        return Carbon::setLocale('id');
    }
}

if (!function_exists(function: 'strCut')) {
    function strCut($string)
    {
        return substr($string, 6);
    }
}

if (!function_exists(function: 'strCutTwo')) {
   function strCutTwo($string)
   {
       return substr($string, 12);
   }
}

if (!function_exists(function: 'verifikatorProfile')) {
    function verifikatorProfile($verifikator)
    {
        $verifikator = Crypt::decrypt($verifikator);
        $user = User::where('nip', $verifikator)->first('name');
        return $user ? 'Verifikator - ' . $user->name : '';
    }
}

if (!function_exists('areYouVerifikator')) {
   function areYouVerifikator($verifikator)
   {
       $verifikator = Crypt::decrypt($verifikator);
       return Auth::user()->nip == $verifikator;
   }
}

