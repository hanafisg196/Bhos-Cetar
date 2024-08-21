<?php

namespace App\Livewire;

use App\Services\ScheduleService;
use Illuminate\Support\Facades\Crypt;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Attributes\On;

class InboxDetailLive extends Component
{

    protected ScheduleService $scheduleService;

    public function boot(
        ScheduleService $scheduleService
    ) {
        $this->scheduleService = $scheduleService;
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
        return view('livewire.inbox-detail-live');
    }

    public function mount($id)
    {
        $this->showDetail($this->id = $id);
    }

    public function sliceStr($string)
    {
        return substr($string, 6);
    }

    public function download($file)
    {
        return response()->download(
            storage_path('app/public/' . $file)
        );
    }

    public function showDetail($id)
    {
        $id = Crypt::decrypt($id);
        $this->data = $this->scheduleService->getDetailSchedule($id);
    }

    public function updateStatus($id)
    {
        $this->validate();
        $this->scheduleService->updateStatSchdeule($id, $this->status, $this->pesan);
        session()->flash('status', 'Data berhasil di update.');
        $this->redirect('/inbox/list');
    }


}
