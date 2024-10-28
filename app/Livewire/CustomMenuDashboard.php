<?php

namespace App\Livewire;

use App\Services\RoleService;
use Livewire\Component;

class CustomMenuDashboard extends Component
{
    protected RoleService $roleService;
    public $checkUploaderOne;
    public $checkUploaderTwo;
    public $adminCheck;
    public function boot(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }
    public function mount()
    {
        $this->checkUploader();
        $this->isAdmin();
    }

    public function checkUploader()
    {
        $this->checkUploaderOne = $this->roleService->kamiPeduliUploader();
        if (!$this->checkUploaderOne) {
            $this->checkUploaderTwo = $this->roleService->ecorrectionUploader();
        }
    }
    public function isAdmin()
    {
     $this->adminCheck =  $this->roleService->adminCheck();
    }
    public function render()
    {
        return view('livewire.custom-menu-dashboard');
    }
}
