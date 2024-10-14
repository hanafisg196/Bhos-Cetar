<?php

namespace App\Http\Controllers;

use App\Services\LoginService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    protected LoginService $loginService;
    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }
    public function index(Request $request)
    {
        if(Auth::user() !=null)
        {
            return redirect()->route('dashboard');
        }

        return view('dashboard.page.login');
    }

    public function doLogin(Request $request) {
        return  $this->loginService->login($request);
    }

    public function doLogout() {
        $this->loginService->logout();
        return redirect()->route('login');
    }


}
