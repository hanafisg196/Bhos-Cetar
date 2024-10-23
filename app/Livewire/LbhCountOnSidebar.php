<?php

namespace App\Livewire;

use App\Services\ScheduleService;
use Livewire\Component;

class LbhCountOnSidebar extends Component
{

   protected ScheduleService $scheduleService;
   public $data = 0;
   public function boot(
      ScheduleService $scheduleService,
      )
    {
        $this->scheduleService = $scheduleService;
    }

   public function mount(){

   }
   public function counter(){
      $this->data = $this->scheduleService->countReadLbhAll();
   }
    public function render()
    {
        return view('livewire.lbh-count-on-sidebar');
    }
}
