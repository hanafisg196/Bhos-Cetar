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
        $getKepSubBagHukum = $this->roleService->getKepBagHukum();
        $getSubBagHukumPerundangan = $this->roleService->getSubBagPerundangan();
        $getSubBagBantuanHukum = $this->roleService->getSubBagBantuanHukum();
        $getSubBagDokumentasi = $this->roleService->getSubBagDokumentasi();
        $getSubBagianAnalis = $this->roleService->getSubBagianAnalis();

        $data = $employee['data']['pegawai'];
        $kepSubBagHukum = $getKepSubBagHukum['data']['pegawai'];
        $subBagHukumPerundangan = $getSubBagHukumPerundangan['data']['pegawai'];
        $subBagHukumBantuan = $getSubBagBantuanHukum['data']['pegawai'];
        $subBagDokumentasi = $getSubBagDokumentasi['data']['pegawai'];
        $subBagAnalis = $getSubBagianAnalis['data']['pegawai'];

        return view('admin.page.user-role')->with([
            'code' => $code,
            'opd' => $opd,
            'data' => $data,
            'rule' => $rule,
            'kepSubBagHukum'=> $kepSubBagHukum,
            'subBagHukumPerundangan' => $subBagHukumPerundangan,
            'subBagHukumBantuan' => $subBagHukumBantuan,
            'subBagDokumentasi' => $subBagDokumentasi,
            'subBagAnalis' => $subBagAnalis
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
