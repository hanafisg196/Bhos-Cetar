<?php

namespace App\Http\Controllers;

use App\Services\ScheduleService;
use Illuminate\Http\Request;

class InboxController extends Controller
{
    protected ScheduleService $scheduleService;
    public function __construct(ScheduleService $scheduleService)
    {
        $this->scheduleService = $scheduleService;
    }

    public function getSchedules()
    {

        return view('admin.page.inbox');
    }

    public function inboxDetail($id){
        return view('admin.page.inbox-detail', ['id' => $id]);
    }
}
