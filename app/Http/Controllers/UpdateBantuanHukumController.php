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
    public function getDataById($id){
         $id = Crypt::decrypt($id);
         $data = $this->scheduleService->getDetailSchedule($id);
        return view("dashboard.page.update-bantuan-hukum")->with([
            'data' => $data
        ]);
    }
}
