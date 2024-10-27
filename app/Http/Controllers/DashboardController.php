<?php

namespace App\Http\Controllers;

use App\Services\ReportGrafikService;


class DashboardController extends Controller
{
   protected ReportGrafikService $reportGrafikService;
   public function __construct(ReportGrafikService $reportGrafikService)
   {
       $this->reportGrafikService = $reportGrafikService;
   }
    public function index()
    {
      $reportGrafik = $this->reportGrafikService->getReportKinerjaForUser();
        return view('dashboard.page.home')->with([
         'reportGrafik' => $reportGrafik
        ]);
      // return json_encode($report);
    }
}
