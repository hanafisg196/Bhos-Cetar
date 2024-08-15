<?php

namespace App\Livewire;

use App\Services\ScheduleService;
use Livewire\Component;
use Livewire\WithPagination;

class ListInboxLive extends Component
{
    use WithPagination;
    public $string = "";
    public $perPage = 7;
    public $search = "";

    protected ScheduleService $scheduleService;

    public function boot(
        ScheduleService $scheduleService
    )
    {
        $this->scheduleService = $scheduleService;
    }

    public function mount()
    {

    }
    public function delete($id){
        $this->scheduleService->deleteSchedule($id);
    }

    public function readInbox($id){
        $this->scheduleService->readSchedule($id);
    }

    public function loadMore(){
        $this->perPage += 10;
    }

    public function counterSchedule(){
       return $this->scheduleService->countUsualan();
    }

    public function render()
    {
        if(strlen($this->search) >= 1){
            $data = $this->scheduleService->search($this->search, $this->perPage);
        } else{
            $data = $this->scheduleService->getAllSchedules($this->perPage);
        }
        return view('livewire.list-inbox-live')->with([
            'data'=> $data
        ]);
    }

}
