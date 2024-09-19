<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Services\ReportHamService;
use App\Services\ScheduleService;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
    protected ScheduleService $scheduleService;
    protected ReportHamService $reportHamService;
    public function __construct(
        ScheduleService $scheduleService,
        ReportHamService $reportHamService
        )
    {
        $this->scheduleService = $scheduleService;
        $this->reportHamService = $reportHamService;
    }
    public function index(Request $request)
    {
        $id = $this->scheduleService->getUserId($request);
        $bantuan =  $this->scheduleService->getSchedulesByUser($request);
        $ranham =  $this->reportHamService->getRanhamByUser($request);
        return view('dashboard.page.home')->with([
            'bantuan' => $bantuan,
            'ranham' => $ranham
        ]);
    }

    public function test(Request $request) {
        $user = $request->session()->get('user');
        $user_id = $user['pegawai']['nip'];

        $kons = Notification::where('user_id', $user_id)
            ->where(function ($query) {
                $query->whereHas('schedules', function ($query) {
                    $query->whereIn('status', ['Ditolak', 'Disetujui']);
                })
                ->orWhereHas('ranhams', function ($query) {
                    $query->whereIn('status', ['Ditolak', 'Disetujui']);
                });
            })->get();

            return json_encode($kons);
    }


}
