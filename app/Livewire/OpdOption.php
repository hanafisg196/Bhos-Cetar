<?php

namespace App\Livewire;

use App\Services\RoleService;
use Livewire\Component;

class OpdOption extends Component
{
    public $code = null;
    public $data;
    protected RoleService $roleService;


    public function mount(){
      $employee = $this->roleService->getEmployee($this->code);
      $this->data = $employee['data'];
    }
    public function boot(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    public function render()
    {


        return view('livewire.opd-option');
    }
}
