<?php

namespace App\Livewire;

use App\Services\RoleService;
use App\Services\ScheduleService;
use Illuminate\Support\Facades\Crypt;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Attributes\On;


class DetailBantuanHukum extends Component
{

    protected ScheduleService $scheduleService;
    protected RoleService $roleService;

    public function boot(
        ScheduleService $scheduleService,
        RoleService $roleService
    ) {
        $this->scheduleService = $scheduleService;
        $this->roleService = $roleService;
    }

    public $id;
    public $data;
    public $string;
    public $verifikatorOne;
    public $validVerifikator;
    public $verfikator;
    public $kabag;
    public $hasDispos;
    public $pesan = '';
    public $status = '';
    protected $rules = [
      'verfikator' => 'required',
      'pesan' => 'required',
      'status' => 'required'
    ];
    #[On('showDetail')]
    public function render()
    {
        return view('livewire.detail-bantuan-hukum');
    }

    public function mount($id)
    {
        $this->showDetail($this->id = $id);
        $this->getVerifikatorOne();
        $this->checkAccess();
    }

    public function sliceStr($string)
    {
        return substr($string, 6);
    }

    public function getVerifikatorOne()
    {
      $this->verifikatorOne = $this->roleService->getVerifikatorOne();
    }
    public function download($file)
    {
        return response()->download(
            storage_path('app/public/' . $file)
        );
    }
    public function checkAccess(){
      $this->kabag = $this->roleService->userManagerAdmin();
      $this->validVerifikator = $this->roleService->checkVerifikatorOne();
    }

    public function showDetail($id)
    {
        $id = Crypt::decrypt($id);
        $this->data = $this->scheduleService->getDetailSchedule($id);
    }

    public function updateStatus($id)
    {
      $this->validate([
         'status' => 'required',
         'pesan' => 'required',
       ]);
        $this->scheduleService->updateStatSchdeule($id, $this->status, $this->pesan);
        session()->flash('status', 'Data berhasil di update.');
        $this->redirect(route('admin.list.lbh'));
    }

    public function updateVerifikatorOne($id){
      $this->validate([
         'verfikator' => 'required',
     ]);
      $this->scheduleService->sendToVerifikatorOne($id, $this->verfikator);
      session()->flash('status', 'Verifikator Berhasil Di tentukan');
      $this->redirect(route('admin.list.lbh'));
    }


}
