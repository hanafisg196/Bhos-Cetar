<?php

namespace App\Http\Controllers;

use App\Services\ReportHamService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class UpdateAksiHamController extends Controller
{

    protected ReportHamService $reportHamService;
    public function __construct(ReportHamService $reportHamService){
    $this->reportHamService = $reportHamService;
    }
    public function getRanham($id){
        $id = Crypt::decrypt($id);
        $data = $this->reportHamService->getRanhamByid($id);
        $kkp = $this->reportHamService->getKkp();
        return view("dashboard.page.update-aksi-hukum")->with([
            "data"=> $data,
            "kkp"=> $kkp
        ]);
    }
    public function update(Request $request, $id){
        $id = Crypt::decrypt($id);
        $this->reportHamService->updateRanham($request, $id);
        return redirect()->route("dashboard")->with("success","Data berhasil di perbarui, dan akan di review kembali");
    }
}
