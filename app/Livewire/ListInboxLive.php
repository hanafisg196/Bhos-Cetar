<?php

namespace App\Livewire;

use App\Services\ReportHamService;
use App\Services\ScheduleService;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;

class ListInboxLive extends Component
{
    use WithPagination;
    public $string = "";
    public $perPage = 7;

    public $search = "";

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
            $lbh = $this->scheduleService->search($this->search, $this->perPage);
        } else{
            $lbh = $this->scheduleService->getAllSchedules($this->perPage);
        }

        if(strlen($this->search) >= 1){
            $lah = $this->reportHamService->search($this->search, $this->perPage);
        } else{
            $lah = $this->reportHamService->getRanhamAll($this->perPage);
        }

        return view('livewire.list-inbox-live')->with([
            'lbh'=> $lbh,
            'lah'=> $lah
        ]);
    }



}
