<?php

namespace App\Livewire;

use App\Services\RoleService;
use Illuminate\Http\Request;
use Livewire\Component;

class CustomMenuAdmin extends Component
{ protected RoleService $roleService;
   public $checkAccess;
   public function boot(RoleService $roleService)
   {
       $this->roleService = $roleService;
   }
   public function mount()
   {
       $this->checkAdmin();
   }

   public function checkAdmin()
   {
       $this->checkAccess = $this->roleService->ecorrectionAdmin();

   }
    public function render()
    {
        return view('livewire.custom-menu-admin');
    }


}
