<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Role;
use App\Models\Rule;
use App\Services\ReportHamService;
use App\Services\ScheduleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    protected ScheduleService $scheduleService;
    protected ReportHamService $reportHamService;
    public function __construct(ScheduleService $scheduleService, ReportHamService $reportHamService)
    {
        $this->scheduleService = $scheduleService;
        $this->reportHamService = $reportHamService;
    }
    public function index(Request $request)
    {
        $bantuan = $this->scheduleService->getSchedulesByUser($request);
        $ranham = $this->reportHamService->getRanhamByUser($request);
        $role = session('user_role');
        return view('dashboard.page.home')->with([
            'bantuan' => $bantuan,
            'ranham' => $ranham,
            'role' => $role
        ]);
    }

    public function test()
    {
        $nip = '199101052015031001';
        $test = Rule::where('nip', $nip)->with('ruleType')->first();

        return json_encode($test);
        // $data = session('user_role');

    }
}
