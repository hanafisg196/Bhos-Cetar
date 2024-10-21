<?php

namespace App\Livewire;

use App\Services\EcorrectionService;
use App\Services\RoleService;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;
use Livewire\Attributes\On;
class DetailEcorrection extends Component
{
    protected EcorrectionService $ecorrectionService;
    protected RoleService $roleService;

    public function boot(
      EcorrectionService $ecorrectionService,
      RoleService $roleService
      )
    {
        $this->ecorrectionService = $ecorrectionService;
        $this->roleService = $roleService;
    }
    public $id;
    public $verifikatorTwo;
    public $data;
    public $string;
    public $hasDispos;
    public $verfikator;
    public $pesan = '';
    public $status = '';

    protected $rules = [
        'verfikator' => 'required',
        'pesan' => 'required',
        'status' => 'required'
    ];

    #[On('showDetailEcor')]
    public function render()
    {
        return view('livewire.detail-ecorrection');
    }

    public function mount($id)
    {

        $this->showDetailEcor($this->id = $id);
        $this->getVerifikatorTwo();
        $this->checkDisposAccess();

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

    public function getVerifikatorTwo()
    {
      $this->verifikatorTwo = $this->roleService->getVerifikatorTwo();
    }
    public function checkDisposAccess()
    {
      $this->hasDispos = $this->roleService->disposisiAccess();
    }

    public function updateVerifikatorTwo($id){
      $this->validate([
         'verfikator' => 'required',
     ]);
      $this->ecorrectionService->sendToVerifikatorTwo($id, $this->verfikator);
      session()->flash('status', 'Verifikator Berhasil Di tentukan');
      $this->redirect(route('admin.list.ecorrection'));
    }

    public function updateEcor($id){
      $this->validate([
         'status' => 'required',
         'pesan' => 'required',
     ]);
      $this->ecorrectionService->updateStatEcorrection($id, $this->status,$this->pesan);
      $this->dispatch('notif-created');
      session()->flash('status', 'Data berhasil di update.');
      $this->redirect(route('admin.list.ecorrection'));
    }

}
