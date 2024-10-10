<?php

namespace App\Http\Controllers;

use App\Services\RoleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class UserManagementController extends Controller
{
    private RoleService $roleService;

    public function __construct(RoleService $roleService) {
        $this->roleService = $roleService;
    }
    public function index(){

        $data = $this->roleService->getRole();
        $rule = $this->roleService->getRuleType();
        return view('admin.page.user-management')->with([
         'data' => $data,
         'rule' => $rule
        ]);
    }
    public function formAddRole(){
        $rule = $this->roleService->getRuleType();
        $employee = $this->roleService->getEmployee();
        $data  = $employee['data'];
        return view('admin.page.user-role')->with([
            'data' => $data,
            'rule' => $rule
        ]);
    }

    public function createEmployeeRule(Request $request){
       $this->roleService->setRuleEmployee($request);
       return back()->with('success', 'Form submitted successfully!');
    }

    public function updateEmployeeRule(Request $request, $id){
      $id = Crypt::decrypt($id);
      $this->roleService->updateRuleEmployee($request, $id);
      return back()->with('success', 'Form submitted successfully!');
    }

}
