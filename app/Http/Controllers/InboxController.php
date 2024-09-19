<?php

namespace App\Http\Controllers;

use App\Services\ScheduleService;
use Illuminate\Http\Request;

class InboxController extends Controller
{
    protected ScheduleService $scheduleService;
    public function __construct(ScheduleService $scheduleService)
    {
        $this->scheduleService = $scheduleService;
    }

    public function getListLbh()
    {
        return view('admin.page.list-inbox-lbh');
    }
    public function getListLah()
    {
        return view('admin.page.list-inbox-lah');
    }

    public function detailBantuanHukum($id){
        return view('admin.page.page-bantuan-hukum', ['id' => $id]);
    }
    public function detailAksiHam($id){
        return view('admin.page.page-aksi-ham', ['id' => $id]);
    }
}
