<?php

namespace App\Livewire;

use App\Models\User;
use App\Services\ReportHamService;
use App\Services\RoleService;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;
use Livewire\Attributes\On;

class DetailAksiHam extends Component
{
    protected ReportHamService $reportHamService;
    protected RoleService $roleService;
    public $id;
    public $data;
    public $string;
    public $verifikator;
    public $vname;
    public $verifikatorOne;
    public $checkKabag;
    public $checkVerifikator;
    public $pesan = '';
    public $pesanKhusus;
    public $status = '';
    protected $rules = [
        'vname' => 'required|string',
        'verifikator' => 'required|string',
        'pesan' => 'required|string',
        'status' => 'required|string',
    ];
    #[On('showDetail')]
    public function boot(ReportHamService $reportHamService, RoleService $roleService)
    {
        $this->reportHamService = $reportHamService;
        $this->roleService = $roleService;
    }
    public function render()
    {
        return view('livewire.detail-aksi-ham');
    }
    public function mount($id)
    {
        $this->showDetail($this->id = $id);
        $this->getVerifikatorOne();
        $this->checkAccess();
        $this->updatedVerifikator($this->vname);
    }
    public function showDetail($id)
    {
        $id = Crypt::decrypt($id);
        $this->data = $this->reportHamService->getRanhamByid($id);
    }
    public function getVerifikatorOne()
    {
        $this->verifikatorOne = $this->roleService->getVerifikatorOne();
    }
    public function checkAccess()
    {
        $this->checkKabag = $this->roleService->disposisiAccess();
        $this->checkVerifikator = $this->roleService->checkVerifikatorOne();
    }
    public function updateStat($id)
    {
        $this->validate([
            'status' => 'required',
            'pesan' => 'required',
        ]);
        $this->reportHamService->updateStatRanham($id, $this->status, $this->pesan);
        session()->flash('status', 'Data berhasil di update.');
        $this->redirect(route('admin.list.lah'));
    }
    public function updateVerifikatorOne($id)
    {
        $this->validate([
            'vname' => 'required|string',
            'verifikator' => 'required|string',
        ]);

        $this->reportHamService->sendToVerifikatorOne($id, $this->verifikator, $this->vname, $this->pesanKhusus);
        session()->flash('status', 'Verifikator Berhasil Di tentukan');
        $this->redirect(route('admin.list.lah'));
    }
    public function updatedVerifikator($value)
    {
        $verifikator = User::where('nip', $value)->first();
        $this->vname = $verifikator ? $verifikator->name : '';
    }
}
