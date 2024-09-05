<?php

namespace App\Http\Controllers;

use App\Services\ReportHamService;
use Illuminate\Http\Request;

class ReportHamController extends Controller
{
    protected ReportHamService $reportHamService;
    public function __construct(ReportHamService $reportHamService){
        $this->reportHamService = $reportHamService;
    }

    public function index() {
        $kkp = $this->reportHamService->getKkp();
        return view("dashboard.page.ranham")->with([
            "kkp"=> $kkp
        ]);
    }
    public function createRanham(Request $request) {
        $this->reportHamService->saveRanham($request);
        return redirect()->back()->with("success","konsz");
    }
}
