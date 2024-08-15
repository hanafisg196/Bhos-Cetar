<?php

namespace App\Http\Controllers;

use App\Services\ScheduleService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected ScheduleService $scheduleService;
    public function __construct(ScheduleService $scheduleService)
    {
        $this->scheduleService = $scheduleService;
    }

    public function getSchedules()
    {
        $data = $this->scheduleService->getAllSchedules();
        return view('admin.page.inbox')->with('data', $data);
    }

    public function inboxDetail($id){
        return view('admin.page.inbox-detail', ['id' => $id]);
    }

}
