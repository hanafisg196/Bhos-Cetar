<?php

namespace App\Http\Controllers;

use App\Services\EmployeeService;
use App\Services\RoleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

class UserManagementController extends Controller
{
    protected RoleService $roleService;
    protected EmployeeService $employeeService;

    public function __construct(
      RoleService $roleService,
      EmployeeService $employeeService
      )
    {
        $this->roleService = $roleService;
        $this->employeeService = $employeeService;
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

        $employee = $this->employeeService->getEmployee($code);
        $getKabagTata = $this->employeeService->getKabagTata();
        $getKasubagAdmPemerintah = $this->employeeService->getKasubagAdmPemerintah();
        $getKasubagAdmKewilayahan = $this->employeeService->getKasubagAdmKewilayahan();
        $getKasubagOtonomi = $this->employeeService->getKasubagOtonomi();
        $getAnalisAhliMuda = $this->employeeService->getAnalisAhliMuda();
        $getAnalisDukcapil = $this->employeeService->getAnalisDukcapil();
        $getAnalisDataInformasi = $this->employeeService->getAnalisDataInformasi();



        $getKabagKesra = $this->employeeService->getKabagKesra();
        $getKasubagSpritual = $this->employeeService->getKasubagSpritual();
        $getKasubagSosial = $this->employeeService->getKasubagSosial();
        $getKasubagMasyarakat = $this->employeeService->getKasubagMasyarakat();
        $getPegerakSwadaya = $this->employeeService->getPegerakSwadaya();

        $getKepSubBagHukum = $this->employeeService->getKepBagHukum();
        $getSubBagHukumPerundangan = $this->employeeService->getSubBagPerundangan();
        $getSubBagBantuanHukum = $this->employeeService->getSubBagBantuanHukum();
        $getSubBagDokumentasi = $this->employeeService->getSubBagDokumentasi();
        $getSubBagianAnalis = $this->employeeService->getSubBagianAnalis();

        $data = $employee['data']['pegawai'];

        if($code == '02.01.42.'){
         $kabagTata = $getKabagTata['data']['pegawai'];
         $kasubagAdmKewilayahan = $getKasubagAdmKewilayahan['data']['pegawai'];
         $kasubagAdmPemerintah = $getKasubagAdmPemerintah['data']['pegawai'];
         $kasubagOtonomi = $getKasubagOtonomi['data']['pegawai'];
         $analisAhliMuda = $getAnalisAhliMuda['data']['pegawai'];
         $analisDukcapil = $getAnalisDukcapil['data']['pegawai'];
         $analisDataInformasi = $getAnalisDataInformasi['data']['pegawai'];


         $kabagKesra = $getKabagKesra['data']['pegawai'];
         $kasubagSpritual =  $getKasubagSpritual['data']['pegawai'];
         $kasubagSosial = $getKasubagSosial ['data']['pegawai'];
         $kasubagMasyarakat =  $getKasubagMasyarakat['data']['pegawai'];
         $pegerakSwadaya = $getPegerakSwadaya['data']['pegawai'];

         $kepSubBagHukum = $getKepSubBagHukum['data']['pegawai'];
         $subBagHukumPerundangan = $getSubBagHukumPerundangan['data']['pegawai'];
         $subBagHukumBantuan = $getSubBagBantuanHukum['data']['pegawai'];
         $subBagDokumentasi = $getSubBagDokumentasi['data']['pegawai'];
         $subBagAnalis = $getSubBagianAnalis['data']['pegawai'];
        } else {
         $kabagTata = [];
         $kasubagAdmKewilayahan = [];
         $kasubagAdmPemerintah = [];
         $kasubagOtonomi = [];
         $analisAhliMuda = [];
         $analisDukcapil = [];
         $analisDataInformasi = [];


         $kabagKesra = [];
         $kasubagSpritual =  [];
         $kasubagSosial = [];
         $kasubagMasyarakat =  [];
         $pegerakSwadaya = [];

         $kepSubBagHukum = [];
         $subBagHukumPerundangan = [];
         $subBagHukumBantuan = [];
         $subBagDokumentasi = [];
         $subBagAnalis = [];
        }



        return view('admin.page.user-role')->with([
            'code' => $code,
            'opd' => $opd,
            'data' => $data,
            'rule' => $rule,
            'kabagTata' => $kabagTata,
            'kasubagAdmKewilayahan' => $kasubagAdmKewilayahan,
            'kasubagAdmPemerintah' => $kasubagAdmPemerintah,
            'kasubagOtonomi' => $kasubagOtonomi,
            'analisAhliMuda' => $analisAhliMuda,
            'analisDukcapil' => $analisDukcapil,
            'analisDataInformasi' => $analisDataInformasi,
            'kabagKesra' => $kabagKesra,
            'kasubagSpritual'=> $kasubagSpritual,
            'kasubagSosial'=> $kasubagSosial,
            'kasubagMasyarakat'=> $kasubagMasyarakat,
            'pegerakSwadaya'=> $pegerakSwadaya,
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
