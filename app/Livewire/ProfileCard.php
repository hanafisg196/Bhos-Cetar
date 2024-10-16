<?php

namespace App\Livewire;

use App\Services\ProfileService;
use Illuminate\Http\Request;
use Livewire\Component;

class ProfileCard extends Component
{

    protected ProfileService $profileService;

    public function boot(
        ProfileService $profileService
    ) {
        $this->profileService = $profileService;

    }

    public function render()
    {
        $data = $this->profileService->getCardName();
        return view('livewire.profile-card')->with('data', $data);
    }
}
