<?php

namespace App\Services\Impl;

use App\Models\Ranham;
use App\Models\Schedule;
use App\Services\AdminService;

class AdminServiceImpl implements AdminService
{
    public function countReportYear()
    {
        $lbh = Schedule::whereYear('created_at', now())->count();
        $lah = Ranham::whereYear('created_at', now())->count();
        $data = $lbh + $lah;
        return $data;
    }
    public function countReportMonth()
    {
        $lbh = Schedule::whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])->count();
        $lah = Ranham::whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])->count();

        $data = $lbh + $lah;
        return $data;
    }
    public function countReportWeek()
    {
        $lbh = Schedule::whereBetween('created_at', [
            now()->startOfWeek(),
            now()->endOfWeek()])->count();
        $lah = Ranham::whereBetween('created_at', [
            now()->startOfWeek(),
            now()->endOfWeek()])->count();
        $data = $lbh + $lah;
        return $data;
    }

    public function countUpdatedData()
    {
        $lah = Ranham::query()
            ->whereIn('status', ['Usulan', 'Revisi'])
            ->where('read', 0)
            ->count();
        $lbh = Schedule::query()
            ->whereIn('status', ['Usulan', 'Revisi'])
            ->where('read', 0)
            ->count();
        $data = $lah + $lbh;
        return $data;
    }

    public function countInboxLah()
    {
        return Ranham::query()
            ->whereIn('status', ['Usulan', 'Revisi'])
            ->where('read', 0)
            ->count();
    }
    public function countInboxLbh()
    {
        return Schedule::query()
            ->whereIn('status', ['Usulan', 'Revisi'])
            ->where('read', 0)
            ->count();
    }
}
