<?php

namespace App\Livewire;


use App\Services\ScheduleService;
use Livewire\Component;
use Livewire\WithPagination;
class ListInboxLbhLive extends Component
{
    use WithPagination;
    public $string = "";
    public $perPage = 7;
    public $searchLbh = "";
    protected ScheduleService $scheduleService;
    public function boot(
        ScheduleService $scheduleService,
    )
    {
        $this->scheduleService = $scheduleService;
    }
    public function render()
    {
        strlen($this->searchLbh) >= 1 ?
        $lbh = $this->scheduleService
        ->search(
            $this->searchLbh, $this->perPage
        ):
        $lbh = $this->scheduleService
        ->getAllSchedules(
            $this->perPage
        );

        return view('livewire.list-inbox-lbh-live')->with('lbh', $lbh);
    }

    public function delete($id){
        $this->scheduleService->deleteSchedule($id);
    }
    public function readInboxLbh($id){
        $this->scheduleService->readStatus($id);
    }
    public function loadMore(){
        $this->perPage += 10;
    }
    public function counterSchedule(){
        return $this->scheduleService->countUsulan();
     }
}
