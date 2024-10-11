<?php
namespace App\Services;

use Illuminate\Http\Request;

interface LoginService {
    public function login(Request $request);
    public function logout(Request $request);

}
