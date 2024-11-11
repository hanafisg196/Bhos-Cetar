<?php

namespace App\Livewire;


use App\Services\EcorrectionService;
use App\Services\RoleService;
use Livewire\Component;
use Livewire\WithPagination;

class ListInboxEcorLive extends Component
{
    use WithPagination;

    protected EcorrectionService $ecorrectionService;
    protected RoleService $roleService;

    public $perPage = 7;
    public $searchEcor = '';
    public $filter;
    public $checkKabag;
    public $activatedTab = false;
    public $checkVerifikatorTwo;
    public $diposisiReadCount = 0;
    public $usulanReadCount = 0;
    public $disetujuiReadCount = 0;
    public $revisiReadCount = 0;
    public $ditolakReadCount = 0;
    public $allReadCount = 0 ;
    public $diposisiReadCountByVerifikator = 0;
    public $disetujuiReadCountByVerifikator = 0;
    public $diperbaikiReadCountToVerifikator = 0;
    public $ditolakReadCountByVerfikator = 0;

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
      $this->filter = session()->get('activeecor_filter', 'default_filter');
        $this->filterByStatus($this->filter);
        $this->checkAccessKabag();
        $this->countReadStatus();
        $this->checkVerifikatorTwo();
    }
    public function checkAccessKabag(){
      $this->checkKabag = $this->roleService->userManagerAdmin();
    }
    public function filterByStatus($status)
    {
      session()->put('activeecor_filter', $status);
        $this->filter = $status;
    }

    public function placeholder()
    {
      return view('placeholder.center-loading');
    }
    public function render()
    {

      if (!empty($this->searchEcor)) {
         $data = $this->ecorrectionService->search($this->searchEcor, $this->perPage);
     } else {
         if ($this->filter === 'disposisi') {
             $data = $this->ecorrectionService->disposisiEcorrections($this->perPage);
             $this->activatedTab = false;
         } elseif ($this->filter === 'usulan') {
             $data = $this->ecorrectionService->ususlanEcorrections($this->perPage);
             $this->activatedTab = false;
         } elseif ($this->filter === 'ditolak') {
             $data = $this->ecorrectionService->ditolakEcorrections($this->perPage);
             $this->activatedTab = false;
         } elseif ($this->filter === 'disetujui') {
             $data = $this->ecorrectionService->disetujuiEcorrections($this->perPage);
             $this->activatedTab = false;
         } elseif ($this->filter === 'revisi') {
             $data = $this->ecorrectionService->revisiEcorrections($this->perPage);
             $this->activatedTab = false;
         } elseif ($this->filter === 'yourdispos') {
            $data = $this->ecorrectionService->disposisiByVerifikator($this->perPage);
            $this->activatedTab = true;
         } elseif($this->filter === 'yourDisetujui'){
            $data = $this->ecorrectionService->getrDisetujuiByVerfikatorTwo($this->perPage);
            $this->activatedTab = true;
         }
           elseif($this->filter === 'yourDitolak'){
            $data = $this->ecorrectionService->getrDitolakByVerfikatorTwo($this->perPage);
            $this->activatedTab = true;
         }
           elseif($this->filter === 'yourDiperbaiki'){
            $data = $this->ecorrectionService->getDiperbaikiToVerfikatorTwo($this->perPage);
            $this->activatedTab = true;
         }
           else {
            if($this->checkVerifikatorTwo === true ){

               $data = $this->ecorrectionService->disposisiByVerifikator($this->perPage);
               $this->activatedTab = true;
               $this->filter='yourdispos';
            } else {
               $data = $this->ecorrectionService->ususlanEcorrections($this->perPage);
               $this->activatedTab = false;
               $this->filter='usulan';
            }

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
      //by verifikator
      $this->diposisiReadCountByVerifikator = $this->ecorrectionService->countReadEcorDisposisiByVerfikator();
      $this->disetujuiReadCountByVerifikator = $this->ecorrectionService->countReadEcorDisetujuiByVerfikator();
      $this->ditolakReadCountByVerfikator = $this->ecorrectionService->countReadEcorDitolakByVerfikator();
      $this->diperbaikiReadCountToVerifikator = $this->ecorrectionService->countReadEcorDiperbaikiToVerfikator();

    }

    public function checkVerifikatorTwo(){
         $this->checkVerifikatorTwo = $this->roleService->checkVerifikatorTwo();
    }
}
