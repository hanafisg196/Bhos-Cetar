<?php

namespace App\Livewire;

use App\Services\RoleService;
use Livewire\Component;

class CustomTab extends Component
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
       $this->checkRule();
   }
   public function checkRule()
   {
       $this->checkUploaderOne = $this->roleService->kamiPeduliUploader();

       if (!$this->checkUploaderOne) {
           $this->checkUploaderTwo = $this->roleService->ecorrectionUploader();
       }
   }
    public function render()
    {
        return view('livewire.custom-tab');
    }
}
