<?php

namespace App\Http\Controllers;

use App\Services\ScheduleService;
use Illuminate\Http\Request;


class ScheduleController extends Controller
{
    protected ScheduleService $scheduleService;
    public function __construct(ScheduleService $scheduleService)
    {
        $this->scheduleService = $scheduleService;
    }

    public function index(){

        return view('dashboard.page.schedule');
    }

    public function store(Request $request){
       $this->scheduleService->createSchedule($request);
       return redirect()->back()->with('success', 'Laporan Bantuan Berhasil Ditambahkan');
    }

    public function downloadFile($file){
       return $this->scheduleService->download($file);
    }



}
