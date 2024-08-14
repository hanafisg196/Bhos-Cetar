<?php
namespace App\Services\Impl;

use App\Services\ProfileService;
use Illuminate\Http\Request;

class ProfileServiceImpl implements ProfileService {
    public function getCardName(Request $request){
        return  $request->session()->get('user');

    }

}
