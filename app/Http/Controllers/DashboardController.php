<?php

namespace App\Http\Controllers;

use App\Services\ScheduleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    protected ScheduleService $scheduleService;
    public function __construct(ScheduleService $scheduleService)
    {
        $this->scheduleService = $scheduleService;
    }
    public function index(Request $request)
    {
        $id = $this->scheduleService->getUserId($request);
        $data =  $this->scheduleService->getSchedulesByid($id);

        return view('dashboard.page.home')->with('data', $data);
    }


}
