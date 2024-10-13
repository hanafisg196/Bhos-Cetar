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
   public function mount(Request $request)
   {
       $this->checkUploader($request);
   }

   public function checkUploader($request)
   {
       $this->checkUploaderOne = $this->roleService->kamiPeduliUploader($request);
       if (!$this->checkUploaderOne) {
           $this->checkUploaderTwo = $this->roleService->ecorrectionUploader($request);
       }
   }
    public function render()
    {
        return view('livewire.custom-menu-dashboard');
    }
}
