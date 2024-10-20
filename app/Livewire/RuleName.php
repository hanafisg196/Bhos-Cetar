<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class RuleName extends Component
{

    public function render()
    {
       $data =  Auth::user()->rules;
        return view('livewire.rule-name')->with('data', $data);
    }
}
