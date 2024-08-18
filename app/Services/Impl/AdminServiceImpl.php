<?php

namespace App\Services\Impl;

use App\Models\Schedule;
use App\Services\AdminService;


class AdminServiceImpl implements AdminService
{

    public function countReportYear()
    {

        return  Schedule::whereYear('created_at', now())->count();
    }
    public function countReportMonth()
    {
        return Schedule::whereBetween('created_at',
         [
            now()->startOfMonth(),
            now()->endOfMonth()
         ]
        )->count();
    }
    public function countReportWeek()
    {
        return  Schedule::whereBetween(
            'created_at',
            [
                now()->startOfWeek(),
                now()->endOfWeek()
            ]
        )->count();
    }
}
