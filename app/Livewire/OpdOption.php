<?php

namespace App\Livewire;

use App\Services\RoleService;
use Livewire\Component;

class OpdOption extends Component
{
    public $opd = [];
    public $data;
    public $selectedOpd = '01.01.';

    protected RoleService $roleService;

    public function boot(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    public function mount()
    {
        $this->opd = $this->roleService->getOpdEmployee();
        $this->updateEmployeeData();
    }

    public function updatedSelectedOpd($value)
    {
        $this->updateEmployeeData();
    }

    protected function updateEmployeeData()
    {
        $employee = $this->roleService->getEmployee($this->selectedOpd);
        $this->data = $employee['data'];
    }

    public function render()
    {
        return view('livewire.opd-option');
    }
}
