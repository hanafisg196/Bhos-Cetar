<?php

namespace App\Livewire;

use App\Services\RoleService;
use App\Services\ScheduleService;
use Livewire\Component;
use Livewire\WithPagination;
class ListInboxLbhLive extends Component
{
    use WithPagination;
    public $posId;
    public $track = [];
    public $string = '';
    public $perPage = 7;
    public $searchLbh = '';
    public $activatedTab = false;
    public $filter;
    public $status;
    public $checkVerifikatorOne;
    public $checkKabag;
    public $allReadCount = 0;
    public $diposisiCount = 0;
    public $usulanReadCount = 0;
    public $disetujuiCount = 0;
    public $revisiCount = 0;
    public $ditolakCount = 0;
    public $diposisiReadCountByVerifikator = 0;
    public $disetujuiCountByVerifikator = 0;
    public $diperbaikiReadCountTpVerifikator = 0;
    public $ditolakCountByVerfikator = 0;

    protected ScheduleService $scheduleService;
    protected RoleService $roleService;
    public function boot(ScheduleService $scheduleService, RoleService $roleService)
    {
        $this->scheduleService = $scheduleService;
        $this->roleService = $roleService;
    }

    public function placeholder()
    {
      return view('placeholder.center-loading');
    }
    public function mount()
    {
        $this->filterByStatus($this->filter);
        $this->checkAccessKabag();
        $this->checkAccessVerifikator();
        $this->counter();
        // $this->trackingPoint($this->posId);
    }
    public function render()
    {
        if (!empty($this->searchLbh)) {
            $lbh = $this->scheduleService->search($this->searchLbh, $this->perPage);
        } else {
            if ($this->filter === 'disposisiVerifikator') {
                $lbh = $this->scheduleService->disposisiByVerifikator($this->perPage);
                $this->activatedTab = true;
            } elseif ($this->filter === 'usulan') {
                $lbh = $this->scheduleService->ususlanLbh($this->perPage);
                $this->activatedTab = false;
            } elseif ($this->filter === 'disposisi') {
                $lbh = $this->scheduleService->disposisiLbh($this->perPage);
                $this->activatedTab = false;
            } elseif ($this->filter === 'ditolak') {
                $lbh = $this->scheduleService->ditolakLbh($this->perPage);
                $this->activatedTab = false;
            } elseif ($this->filter === 'disetujui') {
                $lbh = $this->scheduleService->disetujuiLbh($this->perPage);
                $this->activatedTab = false;
            } elseif ($this->filter === 'revisi') {
                $lbh = $this->scheduleService->revisiLbh($this->perPage);
                $this->activatedTab = false;
            } elseif ($this->filter === 'ditolakVerifikator') {
                $lbh = $this->scheduleService->ditolakByVerifikator($this->perPage);
                $this->activatedTab = true;
            } elseif ($this->filter === 'disetujuiVerifikator') {
                $lbh = $this->scheduleService->disetujuiByVerifikator($this->perPage);
                $this->activatedTab = true;
            } elseif ($this->filter === 'diperbaikiToVerifikator') {
                $lbh = $this->scheduleService->diperbaikiToVerifikator($this->perPage);
                $this->activatedTab = true;
            } else {
                if ($this->checkVerifikatorOne === true) {
                    $lbh = $this->scheduleService->disposisiByVerifikator($this->perPage);
                    $this->activatedTab = true;
                    $this->filter = 'disposisiVerifikator';
                } else {
                    $lbh = $this->scheduleService->ususlanLbh($this->perPage);
                    $this->activatedTab = false;
                    $this->filter = 'usulan';
                }
            }
        }
        return view('livewire.list-inbox-lbh-live')->with('lbh', $lbh);
    }
    public function checkAccessKabag()
    {
        $this->checkKabag = $this->roleService->userManagerAdmin();
    }

    public function checkAccessVerifikator()
    {
        $this->checkVerifikatorOne = $this->roleService->checkVerifikatorOne();
    }
    public function filterByStatus($status)
    {
        $this->filter = $status;
    }
    public function delete($id)
    {
        $this->scheduleService->deleteSchedule($id);
    }
    public function readInboxLbh($id)
    {
        $this->scheduleService->readStatus($id);
    }
    public function loadMore()
    {
        $this->perPage += 10;
    }
    public function alertDeny()
    {
        $this->js(
            <<<JS
                Swal.fire("SweetAlert2 is working!");
            JS
            ,
        );
    }
    public function counter()
    {
        $this->allReadCount = $this->scheduleService->countReadLbhAll();
        $this->usulanReadCount = $this->scheduleService->countReadLbhUsulan();
        $this->diposisiCount = $this->scheduleService->countLbhDisposisi();
        $this->ditolakCount = $this->scheduleService->countLbhDitolak();
        $this->disetujuiCount = $this->scheduleService->countLbhDisetujui();
        $this->revisiCount = $this->scheduleService->countLbhRevisi();
        $this->diposisiReadCountByVerifikator = $this->scheduleService->countReadLbhDisposisiByVerfikator();
        $this->diperbaikiReadCountTpVerifikator = $this->scheduleService->countReadLbhDiperbaikiToVerfikator();
        $this->disetujuiCountByVerifikator = $this->scheduleService->countLbhDisetujuiByVerfikator();
        $this->ditolakCountByVerfikator = $this->scheduleService->countLbhDitolakByVerfikator();
    }
}
