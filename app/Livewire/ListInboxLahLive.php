<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\ReportHamService;
use Livewire\WithPagination;

class ListInboxLahLive extends Component
{
    use WithPagination;
  public $string = "";
    public $perPage = 7;
    public $searchLah = "";
    public $option = [];
    public $selectedCat;
    protected ReportHamService $reportHamService;
    public function boot(
        ReportHamService $reportHamService
    )
    {
        $this->reportHamService = $reportHamService;
    }


    public function mount()
    {
        $this->option = $this->reportHamService->lisCatRan();

    }


    public function render()
    {
        if(strlen($this->searchLah) >= 1){
             $lah = $this->reportHamService->search($this->searchLah, $this->perPage);
        }
        elseif($this->selectedCat && $this->selectedCat !== 'Pilih...'){

            $lah = $this->reportHamService->getDataByCatRan($this->selectedCat,$this->perPage);
            $this->searchLah = '';
        }
        else{

             $lah = $this->reportHamService->getRanhamAll($this->perPage);
        }

        return view('livewire.list-inbox-lah-live')->with('lah', $lah);
    }



    public function readInboxLah($id){
        $this->reportHamService->readStatus($id);
    }

    public function loadMore(){
        $this->perPage += 10;
    }

}
