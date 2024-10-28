<?php

namespace App\Http\Controllers;

use App\Services\ReportGrafikService;
use App\Services\RoleService;

class AdminController extends Controller
{
    protected ReportGrafikService $reportGrafikService;
    protected RoleService $roleService;
    public function __construct(
       ReportGrafikService $reportGrafikService,
       RoleService $roleService
      )
    {
        $this->reportGrafikService = $reportGrafikService;
        $this->roleService = $roleService;
    }

    public function index()
    {
        $checkAccess = $this->roleService->userManagerAdmin();
        $report = $this->reportGrafikService->getLbhReport();
        $test = $this->reportGrafikService->getReportKinerja();
        $statReport = $this->reportGrafikService->getReportKinerjaByVerifikator();
        return view('admin.page.dashboard')->with([
            'report' => $report,
            'test' => $test,
            'statReport' => $statReport,
            'checkAccess' => $checkAccess
        ]);
    }
}
