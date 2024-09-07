<?php

namespace App\Livewire;

use App\Services\NotificationService;
use Illuminate\Http\Request;
use Livewire\Component;

class NotificationLive extends Component
{


    public $countNotif = 0;
    protected NotificationService $notificationService;

    public function boot(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }
    public function mount(Request $request){
      $this->countNotif = $this->notificationService->count($request);
    }


    public function render()
    {
        return view('livewire.notification-live');
    }
}
