<?php

namespace App\Livewire;

use App\Services\EcorrectionService;
use Livewire\Component;
use Livewire\WithPagination;

class ListInboxEcorLive extends Component
{
   protected EcorrectionService $ecorrectionService;
   use WithPagination;

   public function boot(EcorrectionService $ecorrectionService){
     $this->ecorrectionService = $ecorrectionService;
   }
   public function render()
   {
     $data = $this->ecorrectionService->getListEcorrection();
     return view('livewire.list-inbox-ecor-live')->with([
        'data' => $data
     ]);
   }
}
