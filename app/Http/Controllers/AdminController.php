<?php

namespace App\Http\Controllers;

use App\Services\AdminService;
use App\Services\ReportGrafikService;

class AdminController extends Controller
{
    protected ReportGrafikService $reportGrafikService;
    public function __construct(ReportGrafikService $reportGrafikService)
    {
        $this->reportGrafikService = $reportGrafikService;
    }

    public function index()
    {
        $report = $this->reportGrafikService->getLbhReport();

        return view('admin.page.dashboard')->with([
            'report' => $report
        ]);

    }
}
