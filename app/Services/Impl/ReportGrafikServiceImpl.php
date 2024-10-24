<?php
namespace App\Services\Impl;

use App\Models\Ecorrection;
use App\Models\Ranham;
use App\Models\Schedule;
use App\Services\ReportGrafikService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReportGrafikServiceImpl implements ReportGrafikService
{
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
           12 => 'Desember'
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





}
