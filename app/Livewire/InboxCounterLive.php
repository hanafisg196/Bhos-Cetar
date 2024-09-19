<?php

namespace App\Livewire;

use App\Services\ReportHamService;
use App\Services\ScheduleService;
use Livewire\Component;

class InboxCounterLive extends Component
{

    protected ScheduleService $scheduleService;
    protected ReportHamService $reportHamService;

    public function boot(
        ScheduleService $scheduleService,
        ReportHamService $reportHamService
    )
    {
        $this->scheduleService = $scheduleService;
        $this->reportHamService = $reportHamService;
    }

    public function mount()
    {
      $this->countInbox();
    }

    public function countInbox(){
        $lbh = $this->scheduleService->inboxCount();
        $lah = $this->reportHamService->inboxCount();
        $data  = $lbh + $lah;
        return $data;
    }

    public function render()
    {
        return view('livewire.inbox-counter-live');
    }
}
