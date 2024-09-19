<?php

namespace App\Livewire;

use App\Services\AdminService;
use Livewire\Component;

class LahCount extends Component
{
    public $data = 0;
    protected AdminService $adminService;
    public function boot(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }
    public function mount()
    {
        $this->count();
    }
    public function count()
    {
        $this->data = $this->adminService->countInboxLah();
    }
    public function render()
    {
        return view('livewire.lah-count');
    }
}
