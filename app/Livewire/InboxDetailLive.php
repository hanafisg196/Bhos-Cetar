<?php

namespace App\Livewire;

use App\Services\ScheduleService;
use Livewire\Component;

class InboxDetailLive extends Component
{

    protected ScheduleService $scheduleService;

    public function boot(
        ScheduleService $scheduleService
    )

    {
        $this->scheduleService = $scheduleService;
    }



    public function render()
    {
        return view('livewire.inbox-detail-live');
    }
}
