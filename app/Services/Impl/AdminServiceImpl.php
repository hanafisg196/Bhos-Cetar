<?php

namespace App\Services\Impl;

use App\Models\Ecorrection;
use App\Models\Ranham;
use App\Models\Schedule;
use App\Services\AdminService;
use Illuminate\Support\Facades\Auth;

class AdminServiceImpl implements AdminService
{

   private function getUser(){
      return Auth::user();
  }
  private function getUserRole($rule)
  {
      return Auth::user()->rules->pluck('nama')->intersect($rule)->isNotEmpty();
  }
    public function countReportYear()
    {
        $lbh = Schedule::whereYear('created_at', now())->count();
        $lah = Ranham::whereYear('created_at', now())->count();
        return  $lbh + $lah;

    }
    public function countReportMonth()
    {
        $lbh = Schedule::whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])->count();
        $lah = Ranham::whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])->count();

        return  $lbh + $lah;

    }
    public function countReportWeek()
    {
        $lbh = Schedule::whereBetween('created_at', [
            now()->startOfWeek(),
            now()->endOfWeek()])->count();
        $lah = Ranham::whereBetween('created_at', [
            now()->startOfWeek(),
            now()->endOfWeek()])->count();
         return  $lbh + $lah;

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
         return $lah + $lbh;

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

    public function countInboxEcor()
    {

      $user = $this->getUser();
      $kabag = $this->getUserRole('KABAG');
      if($kabag){
         return Ecorrection::query()
         ->where('status', 'Usulan')
         ->where('read', 0)
         ->count();
      } else {
         return Ecorrection::query()
         ->whereIn('status', ['Disposisi', 'Revisi'])
         ->where('read', 0)
         ->where('dispos_id', $user->id)
         ->count();
      }

    }
}
