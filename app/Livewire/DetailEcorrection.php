<?php

namespace App\Livewire;

use App\Services\EcorrectionService;
use Illuminate\Support\Facades\Crypt;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class DetailEcorrection extends Component
{
   protected EcorrectionService $ecorrectionService;
   public $data;
   protected $id;


   public function boot(
      EcorrectionService $ecorrectionService
   ) {
       $this->ecorrectionService = $ecorrectionService;
   }
   #[Validate('required')]
   public $pesan = '';
   #[Validate('required')]
   public $status = '';
   #[On('showDetail')]

   public function render(){
      return view('livewire.detail-ecorrection');
  }
   public function mount($id){
      $this->showDetail($this->id = $id);
   }

   public function showDetail($id){
      $id = Crypt::decrypt($id);
      $this->data = $this->ecorrectionService->getEcorrectionById($id);
   }
   public function updateStatus($id)
   {
       $this->validate();
       $this->ecorrectionService->updateEcorrectionStat($id, $this->status, $this->pesan);
       session()->flash('status', 'Data berhasil di update.');
       $this->redirect(route('admin.list.ecorrection'));
   }


}
