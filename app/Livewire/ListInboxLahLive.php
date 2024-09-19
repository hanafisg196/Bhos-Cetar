<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\ReportHamService;
use Livewire\WithPagination;

class ListInboxLahLive extends Component
{
    public $string = "";
    public $perPage = 7;
    public $searchLah = "";
    protected ReportHamService $reportHamService;
    public function boot(
        ReportHamService $reportHamService
    )
    {
        $this->reportHamService = $reportHamService;
    }
    public function render()
    {
        strlen($this->searchLah) >= 1 ?
        $lah = $this->reportHamService
        ->search(
            $this->searchLah, $this->perPage
        ):
        $lah = $this->reportHamService
        ->getRanhamAll(
            $this->perPage
        );
        return view('livewire.list-inbox-lah-live')->with('lah', $lah);
    }

    public function readInboxLah($id){
        $this->reportHamService->readStatus($id);
    }

    public function loadMore(){
        $this->perPage += 10;
    }

}
