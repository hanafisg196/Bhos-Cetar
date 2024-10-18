<?php

namespace App\Http\Controllers;

use App\Services\ScheduleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ScheduleController extends Controller
{
    protected ScheduleService $scheduleService;
    public function __construct(ScheduleService $scheduleService)
    {
        $this->scheduleService = $scheduleService;
    }

    public function index(){

        return view('dashboard.page.schedule');
    }

    public function store(Request $request){
       $this->scheduleService->createSchedule($request);
       return redirect()->back()->with('success', 'Laporan Bantuan Berhasil Ditambahkan');
    }

    public function downloadFile($file){
       return $this->scheduleService->download($file);
    }

    public function deleteDokumen($id){
      $id = Crypt::decrypt($id);
      $this->scheduleService->deleteDocument($id);
      session()->flash('success', 'Dokumen berhasil dihapus!');
      return redirect()->back();
  }
  public function update(Request $request,$id){
      $id = Crypt::decrypt($id);
      $this->scheduleService->updateSchedule($request,$id);
      return redirect()->route("dashboard")->with("success","Data berhasil di perbarui, dan akan di review kembali");
  }
  public function getDataById($id){
       $id = Crypt::decrypt($id);
       $data = $this->scheduleService->getDetailSchedule($id);
      return view("dashboard.page.update-bantuan-hukum")->with([
          'data' => $data
      ]);
  }



}
