<?php
namespace App\Services\Impl;

use App\Services\ProfileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileServiceImpl implements ProfileService {
    public function getCardName(){
        return Auth::user();
    }

}
