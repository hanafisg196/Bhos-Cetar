<?php

namespace App\Http\Controllers;

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
        $test = $this->reportGrafikService->getReportKinerja();
        $disposReport = $this->reportGrafikService->getReportKinerjaByVerifikator();

      //   return view('admin.page.dashboard')->with([
      //       'report' => $report,
      //       'test' => $test,
      //       'disposReport' => $disposReport
      //   ]);
           return json_encode($disposReport);
    }
}
