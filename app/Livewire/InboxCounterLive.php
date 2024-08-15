<?php

namespace App\Livewire;

use App\Services\ScheduleService;
use Livewire\Component;

class InboxCounterLive extends Component
{

    protected ScheduleService $scheduleService;

    public function boot(
        ScheduleService $scheduleService
    )
    {
        $this->scheduleService = $scheduleService;
    }

    public function mount()
    {
      $this->countInbox();
    }

    public function countInbox(){
        return $this->scheduleService->inboxCount();
    }

    public function render()
    {
        return view('livewire.inbox-counter-live');
    }
}
