<?php

namespace App\Livewire;

use App\Services\NotificationService;
use Livewire\Attributes\On;
use Livewire\Component;

class NotificationLive extends Component
{
    public $countNotif = 0;
    public $data;
    protected NotificationService $notificationService;

    public function boot(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }
   //  #[On('notif-created')]
   //  public function test(){
   //       dd('test');
   //  }
    public function placeholder()
    {
      return view('placeholder.icon-notif');
    }
    public function mount()
    {
        $this->data = $this->notificationService->getNotify();
        $this->countNotif();

    }

    public function countNotif(){
      $this->countNotif = $this->notificationService->count();
    }

    public function readNotif($id)
    {
        $this->notificationService->updateNotifStat($id);
    }

    public function render()
    {
        return view('livewire.notification-live');
    }
}
