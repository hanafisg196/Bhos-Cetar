<?php

namespace App\Livewire;

use App\Services\ReportHamService;
use Illuminate\Support\Facades\Crypt;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Attributes\On;

class DetailAksiHam extends Component
{
    protected ReportHamService $reportHamService;

    public function boot(
        ReportHamService $reportHamService
    ) {
        $this->reportHamService = $reportHamService;
    }

    public $id;
    public $data;
    public $string;

    #[Validate('required')]
    public $pesan = '';
    #[Validate('required')]
    public $status = '';


    #[On('showDetail')]
    public function render()
    {
        return view('livewire.detail-aksi-ham');
    }

    public function mount($id)
    {
        $this->showDetail($this->id = $id);
    }

    public function showDetail($id)
    {
        $id = Crypt::decrypt($id);
        $this->data = $this->reportHamService->getRanhamByid($id);
    }

    public function updateStatus($id)
    {
        $this->validate();
        $this->reportHamService->updateStatRanham($id, $this->status, $this->pesan);
        session()->flash('status', 'Data berhasil di update.');
        $this->redirect('/inbox/list');
    }


}
