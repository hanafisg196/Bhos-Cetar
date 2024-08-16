<?php

namespace App\Livewire;

use App\Services\ScheduleService;
use Livewire\Component;
use Livewire\Attributes\On;
class InboxDetailLive extends Component
{

    protected ScheduleService $scheduleService;

    public function boot(
        ScheduleService $scheduleService
    )

    {
        $this->scheduleService = $scheduleService;
    }
    public $id;
    public $data;
    public $string;
    public $pesan="";


    #[On('showDetail')]
    public function render()
    {
        return view('livewire.inbox-detail-live');
    }

    public function mount($id) {
        $this->showDetail($this->id= $id);
    }

    public function sliceStr($string){
        return substr($string,6);
    }

    public function download($file) {
        return response()->download(
            storage_path('app/public/'. $file)
        );
    }



    public function showDetail($id){
       $this->data = $this->scheduleService->getDetailSchedule($id);
    }


    #[On('update')]
        public function updateStatus($id, $stat)
        {
            $this->scheduleService->updateStatSchdeule($id, $stat);
        }


        public function proses($id)
        {
            $this->js(<<<JS
                const { value: status } = await Swal.fire({
                    title: "Update Status",
                    input: "select",
                    inputOptions: {
                        1: "Diproses",
                        2: "Ditolak"
                    },
                    inputPlaceholder: "Pilih status",
                    showCancelButton: true,
                    confirmButtonText: "Update",
                    cancelButtonText: "Batal",
                });

                if (status) {
                        Livewire.dispatchSelf('update', $id, status)
                }

            JS);
        }








}
