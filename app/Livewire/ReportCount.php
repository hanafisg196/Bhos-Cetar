<?php

namespace App\Livewire;

use App\Services\AdminService;
use Livewire\Component;

class ReportCount extends Component
{

    public $data = 0;
    protected AdminService $adminService;
    public function boot(
        AdminService $adminService
    ){
        $this->adminService = $adminService;
    }

    public function mount()
    {
       $this->count();
    }
    public function count()
    {
       return $this->data = $this->adminService->countUpdatedData();
    }
    public function render()
    {
        return view('livewire.report-count');
    }
}
