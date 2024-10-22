<?php

namespace App\Livewire;

use App\Services\EcorrectionService;
use App\Services\RoleService;
use Illuminate\Http\Request;
use Livewire\Component;

class CustomMenuAdmin extends Component
{
   public $allReadCount = 0;
   protected RoleService $roleService;
   protected EcorrectionService $ecorrectionService;
   public $checkAccess;
   public $checkAccessUserManager;
   public function boot(
      RoleService $roleService,
      EcorrectionService $ecorrectionService
      )
   {
       $this->roleService = $roleService;
       $this->ecorrectionService = $ecorrectionService;
   }
   public function mount()
   {
       $this->checkAdmin();
       $this->checkUserManager();
       $this->countRead();
   }
   public function checkAdmin()
   {
       $this->checkAccess = $this->roleService->ecorrectionAdmin();

   }
   public function countRead(){
      $this->allReadCount = $this->ecorrectionService->countReadEcorAll();
   }
   public function checkUserManager()
   {
       $this->checkAccessUserManager = $this->roleService->userManagerAdmin();
   }
    public function render()
    {
        return view('livewire.custom-menu-admin');
    }


}
