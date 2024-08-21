<?php

namespace App\Http\Controllers;


use App\Services\AdminService;



class AdminController extends Controller
{
    protected AdminService $adminService;
    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    public function index()
    {
       $tahun =  $this->adminService->countReportYear();
       $bulan =  $this->adminService->countReportMonth();
       $minggu =  $this->adminService->countReportWeek();


        return view('admin.page.dashboard')->with([
            'tahun' => $tahun,
            'bulan' => $bulan,
            'minggu' => $minggu,
        ]);
    }

}
