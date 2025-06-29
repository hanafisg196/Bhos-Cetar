<?php

namespace App\Livewire;

use App\Services\NotificationService;
use Livewire\Component;
use Livewire\WithPagination;

class Notifications extends Component
{

   use WithPagination;
   public $perPage = 6;
   public $countNotif = 0;
   protected NotificationService $notificationService;

   public function boot(NotificationService $notificationService)
   {
       $this->notificationService = $notificationService;
   }
   public function placeholder()
    {
      return view('placeholder.center-loading');
    }
   public function loadMore(){
      $this->perPage += 6;
    }
    public function readNotif($id)
    {
        $this->notificationService->updateNotifStat($id);
    }
    public function render()
    {
      $data =  $this->notificationService->getNotify($this->perPage);
        return view('livewire.notifications')->with(
         'data', $data
        );
    }
}
