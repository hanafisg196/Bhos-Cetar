<?php
namespace App\Services\Impl;

use App\Models\Ecorrection;
use App\Models\Ranham;
use App\Models\Schedule;
use App\Models\User;
use App\Services\ReportGrafikService;
use Illuminate\Support\Facades\Auth;

class ReportGrafikServiceImpl implements ReportGrafikService
{
    private function getUser()
    {
        return Auth::user();
    }

    private function disposisiCollection($user)
    {
        $disposLbh = Schedule::where('verifikator_nip', $user)
            ->where('status', 'Disposisi')
            ->selectRaw('MONTH(created_at) as month, count(code) as total')
            ->groupByRaw('YEAR(created_at), MONTH(created_at)')
            ->get()
            ->map(function ($item) {
                $item->month_name = $this->getMonthName($item->month);
                return $item;
            });

        $disposLah = Ranham::where('verifikator_nip', $user)
            ->where('status', 'Disposisi')
            ->selectRaw('MONTH(created_at) as month, count(code) as total')
            ->groupByRaw('YEAR(created_at), MONTH(created_at)')
            ->get()
            ->map(function ($item) {
                $item->month_name = $this->getMonthName($item->month);
                return $item;
            });

        $disposEcor = Ecorrection::where('verifikator_nip', $user)
            ->where('status', 'Disposisi')
            ->selectRaw('MONTH(created_at) as month, count(code) as total')
            ->groupByRaw('YEAR(created_at), MONTH(created_at)')
            ->get()
            ->map(function ($item) {
                $item->month_name = $this->getMonthName($item->month);
                return $item;
            });

        return collect([$disposLbh, $disposLah, $disposEcor])->flatten();
    }

    private function revisiCollection($user)
    {
        $revisiLbh = Schedule::where('verifikator_nip', $user)
            ->where('status', 'Revisi')
            ->selectRaw('MONTH(created_at) as month, count(code) as total')
            ->groupByRaw('YEAR(created_at), MONTH(created_at)')
            ->get()
            ->map(function ($item) {
                $item->month_name = $this->getMonthName($item->month);
                return $item;
            });

        $revisiLah = Ranham::where('verifikator_nip', $user)
            ->where('status', 'Revisi')
            ->selectRaw('MONTH(created_at) as month, count(code) as total')
            ->groupByRaw('YEAR(created_at), MONTH(created_at)')
            ->get()
            ->map(function ($item) {
                $item->month_name = $this->getMonthName($item->month);
                return $item;
            });

        $revisiEcor = Ecorrection::where('verifikator_nip', $user)
            ->where('status', 'Revisi')
            ->selectRaw('MONTH(created_at) as month, count(code) as total')
            ->groupByRaw('YEAR(created_at), MONTH(created_at)')
            ->get()
            ->map(function ($item) {
                $item->month_name = $this->getMonthName($item->month);
                return $item;
            });

            return collect([$revisiLbh, $revisiLah, $revisiEcor])->flatten();
    }

    private function ditolakCollection($user)
    {
        $ditolakLbh = Schedule::where('verifikator_nip', $user)
            ->where('status', 'Ditolak')
            ->selectRaw('MONTH(created_at) as month, count(code) as total')
            ->groupByRaw('YEAR(created_at), MONTH(created_at)')
            ->get()
            ->map(function ($item) {
                $item->month_name = $this->getMonthName($item->month);
                return $item;
            });

        $ditolakLah = Ranham::where('verifikator_nip', $user)
            ->where('status', 'Ditolak')
            ->selectRaw('MONTH(created_at) as month, count(code) as total')
            ->groupByRaw('YEAR(created_at), MONTH(created_at)')
            ->get()
            ->map(function ($item) {
                $item->month_name = $this->getMonthName($item->month);
                return $item;
            });

        $ditolakEcor = Ecorrection::where('verifikator_nip', $user)
            ->where('status', 'Ditolak')
            ->selectRaw('MONTH(created_at) as month, count(code) as total')
            ->groupByRaw('YEAR(created_at), MONTH(created_at)')
            ->get()
            ->map(function ($item) {
                $item->month_name = $this->getMonthName($item->month);
                return $item;
            });

            return collect([$ditolakLbh, $ditolakLah, $ditolakEcor])->flatten();
    }
    private function disetujuiCollection($user)
    {
        $disetujuiLbh = Schedule::where('verifikator_nip', $user)
            ->where('status', 'Disetujui')
            ->selectRaw('MONTH(created_at) as month, count(code) as total')
            ->groupByRaw('YEAR(created_at), MONTH(created_at)')
            ->get()
            ->map(function ($item) {
                $item->month_name = $this->getMonthName($item->month);
                return $item;
            });

        $disetujuiLah = Ranham::where('verifikator_nip', $user)
            ->where('status', 'Disetujui')
            ->selectRaw('MONTH(created_at) as month, count(code) as total')
            ->groupByRaw('YEAR(created_at), MONTH(created_at)')
            ->get()
            ->map(function ($item) {
                $item->month_name = $this->getMonthName($item->month);
                return $item;
            });

        $disetujuiEcor = Ecorrection::where('verifikator_nip', $user)
            ->where('status', 'Disetujui')
            ->selectRaw('MONTH(created_at) as month, count(code) as total')
            ->groupByRaw('YEAR(created_at), MONTH(created_at)')
            ->get()
            ->map(function ($item) {
                $item->month_name = $this->getMonthName($item->month);
                return $item;
            });

            return collect([$disetujuiLbh, $disetujuiLah, $disetujuiEcor])->flatten();
    }

    private function getMonthName($monthNumber)
    {
        $months = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];

        return $months[$monthNumber] ?? '';
    }
    public function getLbhReport()
    {
        $lbh = Schedule::selectRaw('MONTH(created_at) as month, count(code) as total')
            ->groupByRaw('YEAR(created_at), MONTH(created_at)')
            ->get()
            ->map(function ($item) {
                $item->month = $this->getMonthName($item->month);
                return $item;
            });

        $lah = Ranham::selectRaw('MONTH(created_at) as month, count(code) as total')
            ->groupByRaw('YEAR(created_at), MONTH(created_at)')
            ->get()
            ->map(function ($item) {
                $item->month = $this->getMonthName($item->month);
                return $item;
            });

        $ecor = Ecorrection::selectRaw('MONTH(created_at) as month, count(code) as total')
            ->groupByRaw('YEAR(created_at), MONTH(created_at)')
            ->get()
            ->map(function ($item) {
                $item->month = $this->getMonthName($item->month);
                return $item;
            });
        return [
            'total_lbh' => $lbh,
            'total_lah' => $lah,
            'total_ecor' => $ecor,
        ];
    }

    public function getReportKinerja()
    {
        $verifikators = User::whereHas('rules', function ($query) {
            $query->where('nama', '=', 'VERIFIKATOR 1')->orWhere('nama', '=', 'VERIFIKATOR 2');
        })->get(['nip', 'name']);
        $scheduleCounts = $verifikators->map(function ($verifikator) {
            $count1 = Schedule::where('verifikator_nip', $verifikator->nip)->count();
            $count2 = Ranham::where('verifikator_nip', $verifikator->nip)->count();
            $count3 = Ecorrection::where('verifikator_nip', $verifikator->nip)->count();
            $count = $count1 + $count2 + $count3;
            return [
                'nama' => $verifikator->name,
                'nip' => $verifikator->nip,
                'count' => $count,
            ];
        });
        return $scheduleCounts->values()->toArray();
    }

    public function getReportKinerjaByVerifikator()
    {
        $user = $this->getUser();
        $allDispos = $this->disposisiCollection($user->nip);
        $allRevisi = $this->revisiCollection($user->nip);
        $allDitolak = $this->ditolakCollection($user->nip);
        $allDisetujui = $this->disetujuiCollection($user->nip);
        $disposTotal = $allDispos
            ->groupBy('month_name')
            ->map(function ($items, $monthName) {
                return [
                    'month' => $monthName,
                    'total' => $items->sum('total'),
                ];
            })
            ->values();
        $revisiTotal = $allRevisi
            ->groupBy('month_name')
            ->map(function ($items, $monthName) {
                return [
                    'month' => $monthName,
                    'total' => $items->sum('total'),
                ];
            })
            ->values();
         $ditolakTotal = $allDitolak
            ->groupBy('month_name')
            ->map(function ($items, $monthName) {
                return [
                    'month' => $monthName,
                    'total' => $items->sum('total'),
                ];
            })
            ->values();
         $disetujuiTotal = $allDisetujui
            ->groupBy('month_name')
            ->map(function ($items, $monthName) {
                return [
                    'month' => $monthName,
                    'total' => $items->sum('total'),
                ];
            })
            ->values();
        return [
            'disposTotal' => $disposTotal,
            'revisiTotal' => $revisiTotal,
            'ditolakTotal' => $ditolakTotal,
            'disetujuiTotal' => $disetujuiTotal,
        ];
    }
}
