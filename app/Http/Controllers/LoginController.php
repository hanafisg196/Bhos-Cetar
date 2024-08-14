<?php

namespace App\Http\Controllers;

use App\Services\LoginService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{
    protected LoginService $loginService;
    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }
    public function index()
    {
        return view('dashboard.page.login');
    }

    public function doLogin(Request $request) {

        return  $this->loginService->Login($request);

    }

    public function doLogout(Request $request) {

        $this->loginService->Logout($request);
        return redirect()->route('login');
    }

    public function LogoutAdmin(Request $request) {

        $this->loginService->Logout($request);
        return redirect()->route('login');
    }
}
