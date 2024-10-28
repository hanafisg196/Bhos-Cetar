<?php

namespace App\Http\Controllers;

use App\Services\RoleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

class UserManagementController extends Controller
{
    private RoleService $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }
    public function index()
    {
        $data = $this->roleService->getEmployeeHasAccess();
        $rule = $this->roleService->getRuleType();
        return view('admin.page.user-management')->with([
            'data' => $data,
            'rule' => $rule,
        ]);
    }
    public function formAddRole(Request $request)
    {
        $code = $request->input('code', '01.01.');
        $rule = $this->roleService->getRuleType();
        $opd = $this->roleService->getOpdEmployee();
        $employee = $this->roleService->getEmployee($code);
        if ($code == '02.01.') {
            $data = collect($employee['data']['pegawai'])
                ->filter(function ($item) {
                    $jabatan = ['ASISTEN'];
                    return Str::contains($item['nama_jabatan'], $jabatan);
                })
                ->all();
        } else {
            $data = $employee['data']['pegawai'];
        }
        return view('admin.page.user-role')->with([
            'code' => $code,
            'opd' => $opd,
            'data' => $data,
            'rule' => $rule,
        ]);
    }

    public function createEmployeeRule(Request $request)
    {
        return $this->roleService->setRuleEmployee($request);
    }

    public function updateEmployeeRule(Request $request, $id)
    {
        $id = Crypt::decrypt($id);
        $this->roleService->updateRuleEmployee($request, $id);
        return back()->with('success', 'Data Berhasil Diubah');
    }

    public function deleteEmployeeRule($id)
    {
        $id = Crypt::decrypt($id);
        $this->roleService->deleteRuleEmployee($id);
        return back()->with('success', 'Data Berhasil Dihapus');
    }
}
