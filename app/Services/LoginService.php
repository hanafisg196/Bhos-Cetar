<?php
namespace App\Services;

use Illuminate\Http\Request;

interface LoginService {
    public function Login(Request $request);
    public function Logout(Request $request);
    public function LogoutAdmin();
}
