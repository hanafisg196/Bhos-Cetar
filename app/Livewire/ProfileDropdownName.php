<?php

namespace App\Livewire;

use App\Services\ProfileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProfileDropdownName extends Component
{
    protected ProfileService $profileService;

    public function boot(
        ProfileService $profileService
    ) {

        $this->profileService = $profileService;

    }
    public function render()
    {
        $fullName = Auth::user()->name;
        $firstName = explode(' ', $fullName)[0];
        return view('livewire.profile-dropdown-name')->with('firstName', $firstName);
    }
}
