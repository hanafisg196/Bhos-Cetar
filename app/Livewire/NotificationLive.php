<?php

namespace App\Livewire;

use App\Services\NotificationService;
use Illuminate\Http\Request;
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

    public function placeholder()
    {
        return <<<'HTML'
        <div>


        </div>
        HTML;
    }
    public function mount(Request $request){
      $this->data = $this->notificationService->getNotify($request);
      $this->countNotif = $this->notificationService->count($request);
    }

    public function readNotif($id){
        $this->notificationService->updateNotifStat($id);
    }

    public function render()
    {
        return view('livewire.notification-live');
    }
}
