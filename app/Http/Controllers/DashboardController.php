<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Services\ReportHamService;
use App\Services\ScheduleService;
use Illuminate\Http\Request;


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
        $bantuan =  $this->scheduleService->getSchedulesByUser($request);
        $ranham =  $this->reportHamService->getRanhamByUser($request);
        return view('dashboard.page.home')->with([
            'bantuan' => $bantuan,
            'ranham' => $ranham
        ]);
    }



}
