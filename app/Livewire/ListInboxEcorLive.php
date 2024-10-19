<?php

namespace App\Livewire;

use App\Services\EcorrectionService;
use Livewire\Component;
use Livewire\WithPagination;

class ListInboxEcorLive extends Component
{
   protected EcorrectionService $ecorrectionService;
   use WithPagination;
   public $perPage = 7;
   public $searchEcor = "";
   public function boot(EcorrectionService $ecorrectionService){
     $this->ecorrectionService = $ecorrectionService;
   }

   public function readStat($id){
      $this->ecorrectionService->readStat($id);
   }

   public function loadMore(){
      $this->perPage += 10;
  }
   public function render()
   {
      strlen($this->searchEcor) >= 1 ?
      $data = $this->ecorrectionService
      ->search(
          $this->searchEcor, $this->perPage
      ):
      $data = $this->ecorrectionService
      ->getListEcorrection(
          $this->perPage
      );
     return view('livewire.list-inbox-ecor-live')->with([
        'data' => $data
     ]);
   }
}
