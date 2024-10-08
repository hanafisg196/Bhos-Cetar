<?php

namespace App\Http\Controllers;

use App\Models\Rule;
use App\Services\RoleService;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    private RoleService $roleService;

    public function __construct(RoleService $roleService) {
        $this->roleService = $roleService;
    }
    public function index(){

        $data = $this->roleService->getRole();

        return view('admin.page.user-management')->with('data', $data);
    }
    public function formAddRole(){
        return view('admin.page.user-role');
    }

}
