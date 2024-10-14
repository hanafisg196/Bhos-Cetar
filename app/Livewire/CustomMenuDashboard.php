<?php

namespace App\Livewire;

use App\Services\RoleService;
use Illuminate\Http\Request;
use Livewire\Component;

class CustomMenuDashboard extends Component
{
   protected RoleService $roleService;
   public $checkUploaderOne;
   public $checkUploaderTwo;
   public function boot(RoleService $roleService)
   {
       $this->roleService = $roleService;
   }
   public function mount()
   {
       $this->checkUploader();
   }

   public function checkUploader()
   {
       $this->checkUploaderOne = $this->roleService->kamiPeduliUploader();
       if (!$this->checkUploaderOne) {
           $this->checkUploaderTwo = $this->roleService->ecorrectionUploader();
       }
   }
    public function render()
    {
        return view('livewire.custom-menu-dashboard');
    }
}
