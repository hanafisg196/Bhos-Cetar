<?php

namespace App\Livewire;

namespace App\Livewire;

use App\Models\Ecorrection;
use App\Services\EcorrectionService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ListInboxEcorLive extends Component
{
    use WithPagination;

    protected EcorrectionService $ecorrectionService;

    public $perPage = 7;
    public $searchEcor = '';
    public $filter = 'all';
    public $kabag;
    public $verifikator;

    public function boot(EcorrectionService $ecorrectionService)
    {
        $this->ecorrectionService = $ecorrectionService;
    }

    public function mount()
    {
        $this->filter = 'all';
        $this->test1();
        $this->test2();

    }

    public function test1(){
       $rule = ['KABAG', 'ADMIN'];
      $this->kabag = Auth::user()->rules->pluck('nama')->intersect($rule)->isNotEmpty();
    }
    public function test2() {
      $user = Auth::user();
      $this->verifikator = Ecorrection::where('verifikator_nip', $user->nip)->exists();
  }
    public function filterByStatus($status)
    {
        $this->filter = $status;
    }


    public function render()
    {
        if ($this->filter === 'disposisi') {
         $data = $this->ecorrectionService->disposisiEcorrections($this->perPage);
        } elseif ($this->filter === 'usulan') {
         $data = $this->ecorrectionService->ususlanEcorrections($this->perPage);
        }
        elseif ($this->filter === 'ditolak') {
         $data = $this->ecorrectionService->ditolakEcorrections($this->perPage);
        }
        elseif ($this->filter === 'disetujui') {
         $data = $this->ecorrectionService->disetujuiEcorrections($this->perPage);
        }
        elseif ($this->filter === 'revisi') {
         $data = $this->ecorrectionService->revisiEcorrections($this->perPage);
        }
        else {
            $data = $this->ecorrectionService->allEcorrections($this->perPage);
        }

        return view('livewire.list-inbox-ecor-live')->with([
            'data' => $data,
        ]);
    }

    public function readStat($id)
    {
        $this->ecorrectionService->readStat($id);
    }

    public function loadMore()
    {
        $this->perPage += 10;
    }
}
