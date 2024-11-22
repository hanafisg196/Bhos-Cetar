<?php

namespace App\Http\Controllers;

use App\Models\Ranham;
use App\Services\ReportGrafikService;
use Carbon\Carbon;
use DateTime;

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
            'reportGrafik' => $reportGrafik,
        ]);
    }
}
