<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\ReportHamService;
use App\Services\RoleService;
use Livewire\WithPagination;

class ListInboxLahLive extends Component
{
    use WithPagination;
    public $string = "";
    public $perPage = 7;
    public $searchLah = "";
    public $activatedTab = false;
    public $option = [];
    public $year = [];
    public $filter;
    public $checkVerifikator;
    public $allReadCount = 0 ;
    public $diposisiCount = 0;
    public $usulanReadCount = 0;
    public $disetujuiCount = 0;
    public $revisiCount = 0;
    public $ditolakCount = 0;

    public $diposisiReadCountByVerifikator = 0;
    public $diperbaikiReadCountToVerifikator = 0;
    public $disetujuiCountByVerifikator = 0;
    public $ditolakCountByVerfikator = 0;
    public $checkKabag;
    public $selectedCat;
    public $selectedYear;
    protected ReportHamService $reportHamService;
    protected RoleService $roleService;
    public function boot(
        ReportHamService $reportHamService,
        RoleService $roleService
    )
    {
        $this->reportHamService = $reportHamService;
        $this->roleService = $roleService;
    }
    public function mount()
    {
        $this->year = $this->reportHamService->getYear();
        $this->option = $this->reportHamService->lisCatRan();
        $this->filter = session()->get('activelah_filter', 'default_filter');
        $this->filterByStatus($this->filter);
        $this->checkAccess();
        $this->counter();
    }
    public function placeholder()
    {
      return view('placeholder.center-loading');
    }
    public function checkAccess(){
      $this->checkVerifikator = $this->roleService->checkVerifikatorOne();
      $this->checkKabag = $this->roleService->disposisiAccess();
    }
    public function render()
    {
         if(!empty($this->searchLah)){
            $lah = $this->reportHamService->search($this->searchLah, $this->perPage);
         }
         elseif($this->selectedCat && $this->selectedYear !== 'Pilih...') {
            $this->searchLah = '';
            $lah = $this->reportHamService->getDataByCatRan(
               $this->selectedCat,$this->selectedYear,$this->perPage
            );
         } else {
            if($this->filter === 'disposisiByVerifikator' ){
               $lah = $this->reportHamService->disposisiByVerifikator($this->perPage);
               $this->activatedTab = true;
            }
            elseif($this->filter === 'usulan'){
               $lah = $this->reportHamService->ususlanLah($this->perPage);
               $this->activatedTab = false;
            }
            elseif($this->filter === 'disposisi'){
               $lah = $this->reportHamService->disposisiLah($this->perPage);
               $this->activatedTab = false;
            }
            elseif($this->filter === 'ditolak'){
               $lah = $this->reportHamService->ditolakLah($this->perPage);
               $this->activatedTab = false;
            }
            elseif($this->filter === 'disetujui'){
               $lah = $this->reportHamService->disetujuiLah($this->perPage);
               $this->activatedTab = false;
            }
            elseif($this->filter === 'revisi'){
               $lah = $this->reportHamService->revisiLah($this->perPage);
               $this->activatedTab = false;
            }
            elseif($this->filter === 'ditolakByVerifikator'){
               $lah = $this->reportHamService->ditolakByVerifikator($this->perPage);
               $this->activatedTab = true;
            }
            elseif($this->filter === 'diperbaikiToVerifikator'){
               $lah = $this->reportHamService->diperbaikiToVerifikator($this->perPage);
               $this->activatedTab = true;
            }
            elseif($this->filter === 'disetujuiByVerifikator'){
               $lah = $this->reportHamService->disetujuiByVerifikator($this->perPage);
               $this->activatedTab = true;
            }
            else {
               if($this->checkVerifikator === true){
                  $lah = $this->reportHamService->disposisiByVerifikator($this->perPage);
                  $this->filter = 'disposisiByVerifikator';
                  $this->activatedTab = true;
               } else {
                  $lah = $this->reportHamService->ususlanLah($this->perPage);
                  $this->filter = 'usulan';
                  $this->activatedTab = false;
               }
            }
         }
        return view('livewire.list-inbox-lah-live')->with('lah', $lah);
    }

    public function filterByStatus($status)
    {
      session()->put('activelah_filter', $status);
        $this->filter = $status;
    }

    public function readInboxLah($id){
        $this->reportHamService->readStatus($id);
    }

    public function loadMore(){
        $this->perPage += 10;
    }

    public function alertDeny(){
      $this->js(<<<JS
          Swal.fire("SweetAlert2 is working!");
      JS);
    }
    public function counter()
    {
      $this->allReadCount = $this->reportHamService->countReadLahAll();
      $this->diposisiCount = $this->reportHamService->countLahDisposisi();
      $this->usulanReadCount = $this->reportHamService->countReadLahUsulan();
      $this->disetujuiCount = $this->reportHamService->countLahDisetujui();
      $this->ditolakCount = $this->reportHamService->countLahDitolak();
      $this->revisiCount = $this->reportHamService->countLahRevisi();

      $this->diposisiReadCountByVerifikator = $this->reportHamService->countReadLahDisposisiByVerfikator();
      $this->diperbaikiReadCountToVerifikator = $this->reportHamService->countReadLahDiperbaikiToVerfikator();
      $this->disetujuiCountByVerifikator = $this->reportHamService->countLahDisetujuiByVerfikator();
      $this->ditolakCountByVerfikator = $this->reportHamService->countLahDitolakByVerfikator();

    }

}
