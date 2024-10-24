<?php

namespace App\Livewire;

use App\Services\ReportHamService;
use Livewire\Component;

class LahCountOnSidebar extends Component
{
    protected ReportHamService $reportHamService;
    public $data = 0;
    public function boot(ReportHamService $reportHamService)
    {
        $this->reportHamService = $reportHamService;
    }

    public function mount()
    {
        $this->counter();
    }
    public function counter()
    {
        $this->data = $this->reportHamService->countReadLahAll();
    }

    public function render()
    {
        return view('livewire.lah-count-on-sidebar');
    }
}
