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
    public $id;
    public $data;
    public $string;

    public function mount($id) {
        $this->showDetail($this->id= $id);
    }

    public function sliceStr($string){
        return substr($string,6);
    }

    public function download($file) {
        return response()->download(
            storage_path('app/public/'. $file)
        );
    }

    public function showDetail($id){
       $this->data = $this->scheduleService->getDetailSchedule($id);

    }


    public function render()
    {
        return view('livewire.inbox-detail-live');
    }
}
