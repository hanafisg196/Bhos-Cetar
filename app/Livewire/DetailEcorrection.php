<?php

namespace App\Livewire;

use App\Services\EcorrectionService;
use Illuminate\Support\Facades\Crypt;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Attributes\On;
class DetailEcorrection extends Component
{
    protected EcorrectionService $ecorrectionService;

    public function boot(EcorrectionService $ecorrectionService)
    {
        $this->ecorrectionService = $ecorrectionService;
    }
    public $id;
    public $data;
    public $string;

    #[Validate('required')]
    public $pesan = '';
    #[Validate('required')]
    public $status = '';

    #[On('showDetailEcor')]
    public function render()
    {
        return view('livewire.detail-ecorrection');
    }

    public function mount($id)
    {
        $this->showDetailEcor($this->id = $id);
    }
    public function sliceStr($string)
    {
        return substr($string, 6);
    }
    public function showDetailEcor($id)
    {
        $id = Crypt::decrypt($id);
        $this->data = $this->ecorrectionService->getEcorrectionById($id);
    }

    public function updateEcor($id){
      $this->validate();
      $this->ecorrectionService->updateStatEcorrection($id,  $this->status,$this->pesan,);
      session()->flash('status', 'Data berhasil di update.');
      $this->redirect(route('admin.list.ecorrection'));
    }

}
