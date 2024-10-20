<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Role;
use App\Models\Rule;
use App\Services\EcorrectionService;
use App\Services\ReportHamService;
use App\Services\ScheduleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    protected ScheduleService $scheduleService;
    protected ReportHamService $reportHamService;
    protected EcorrectionService $ecorrectionService;
    public function __construct(
       ScheduleService $scheduleService,
       ReportHamService $reportHamService,
       EcorrectionService $ecorrectionService
       )
    {
        $this->scheduleService = $scheduleService;
        $this->reportHamService = $reportHamService;
        $this->ecorrectionService = $ecorrectionService;
    }
    public function index(Request $request)
    {
        $bantuan = $this->scheduleService->getSchedulesByUser($request);
        $ranham = $this->reportHamService->getRanhamByUser($request);
        $ecor = $this->ecorrectionService->getEcorByUser();
        return view('dashboard.page.home')->with([
            'bantuan' => $bantuan,
            'ranham' => $ranham,
            'ecor' => $ecor,
        ]);
    }
}
