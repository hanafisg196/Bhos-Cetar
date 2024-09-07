<?php

namespace App\Http\Controllers;

use App\Services\ReportHamService;
use App\Services\ScheduleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    protected ScheduleService $scheduleService;
    protected ReportHamService $reportHamService;
    public function __construct(
        ScheduleService $scheduleService,
        ReportHamService $reportHamService
        )
    {
        $this->scheduleService = $scheduleService;
        $this->reportHamService = $reportHamService;
    }
    public function index(Request $request)
    {
        $id = $this->scheduleService->getUserId($request);
        $bantuan =  $this->scheduleService->getSchedulesByid($id);
        $ranham =  $this->reportHamService->getRanhamByUser($id);
        return view('dashboard.page.home')->with([
            'bantuan' => $bantuan,
            'ranham' => $ranham
        ]);
    }


}
