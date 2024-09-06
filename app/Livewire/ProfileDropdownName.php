<?php

namespace App\Livewire;

use App\Services\ProfileService;
use Illuminate\Http\Request;
use Livewire\Component;

class ProfileDropdownName extends Component
{
    protected ProfileService $profileService;

    public function boot(
        ProfileService $profileService
    ) {

        $this->profileService = $profileService;

    }
    public function render(Request $request)
    {
        $data = $this->profileService->getCardName($request);
        $fullName = $data["pegawai"]['nama'];
        $firstName = explode(' ', $fullName)[0];
        return view('livewire.profile-dropdown-name')->with('firstName', $firstName);
    }
}
