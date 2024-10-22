<?php

namespace App\Livewire;

namespace App\Livewire;

use App\Models\Ecorrection;
use App\Services\EcorrectionService;
use App\Services\RoleService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ListInboxEcorLive extends Component
{
    use WithPagination;

    protected EcorrectionService $ecorrectionService;
    protected RoleService $roleService;

    public $perPage = 7;
    public $searchEcor = '';
    public $filter = 'all';
    public $checkKabag;
    public $checkVerifikatorTwo;
    public $diposisiReadCount = 0;
    public $usulanReadCount = 0;
    public $disetujuiReadCount = 0;
    public $revisiReadCount = 0;
    public $ditolakReadCount = 0;
    public $allReadCount = 0 ;
    public $diposisiReadCountByVerifikator = 0;
    public $verifikator;

    public function boot(
      RoleService $roleService,
      EcorrectionService $ecorrectionService
      )
    {
       $this->roleService = $roleService;
        $this->ecorrectionService = $ecorrectionService;
    }

    public function mount()
    {
        $this->filter = 'all';
        $this->checkAccessKabag();
        $this->countReadStatus();
        $this->checkVerifikatorTwo();
    }
    public function checkAccessKabag(){
      $this->checkKabag = $this->roleService->userManagerAdmin();
    }
    public function filterByStatus($status)
    {
        $this->filter = $status;
    }

    public function render()
    {

      if (!empty($this->searchEcor)) {
         $data = $this->ecorrectionService->search($this->searchEcor, $this->perPage);
     } else {
         if ($this->filter === 'disposisi') {
             $data = $this->ecorrectionService->disposisiEcorrections($this->perPage);
         } elseif ($this->filter === 'usulan') {
             $data = $this->ecorrectionService->ususlanEcorrections($this->perPage);
         } elseif ($this->filter === 'ditolak') {
             $data = $this->ecorrectionService->ditolakEcorrections($this->perPage);
         } elseif ($this->filter === 'disetujui') {
             $data = $this->ecorrectionService->disetujuiEcorrections($this->perPage);
         } elseif ($this->filter === 'revisi') {
             $data = $this->ecorrectionService->revisiEcorrections($this->perPage);
         }
         elseif ($this->filter === 'yourdispos') {
            $data = $this->ecorrectionService->disposisiByVerifikator($this->perPage);
         }
         else {
             $data = $this->ecorrectionService->allEcorrections($this->perPage);
         }
     }

        return view('livewire.list-inbox-ecor-live')->with([
            'data' => $data,
        ]);
    }

    public function readStat($id)
    {
        $this->ecorrectionService->readStat($id);
    }

    public function alertDeny(){
        $this->js(<<<JS
            Swal.fire("SweetAlert2 is working!");
        JS);
    }

    public function loadMore()
    {
        $this->perPage += 10;
    }

    public function countReadStatus(){
      $this->usulanReadCount = $this->ecorrectionService->countReadEcorUsulan();
      $this->diposisiReadCount = $this->ecorrectionService->countReadEcorDisposisi();
      $this->ditolakReadCount = $this->ecorrectionService->countReadEcorDitolak();
      $this->disetujuiReadCount = $this->ecorrectionService->countReadEcorDisetujui();
      $this->revisiReadCount = $this->ecorrectionService->countReadEcorRevisi();
      $this->allReadCount = $this->ecorrectionService->countReadEcorAll();
      $this->diposisiReadCountByVerifikator = $this->ecorrectionService->disposisiReadCountByVerifikator();

    }

    public function checkVerifikatorTwo(){
         $this->checkVerifikatorTwo = $this->roleService->checkVerifikatorTwo();
    }
}
