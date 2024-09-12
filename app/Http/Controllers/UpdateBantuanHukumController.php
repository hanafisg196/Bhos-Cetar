<?php

namespace App\Http\Controllers;

use App\Services\ScheduleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class UpdateBantuanHukumController extends Controller
{
    protected ScheduleService $scheduleService;

    public function __construct(ScheduleService $scheduleService){
        $this->scheduleService = $scheduleService;
    }

    public function deleteDokumen($id){
        $id = Crypt::decrypt($id);
        $this->scheduleService->deleteDocument($id);
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
