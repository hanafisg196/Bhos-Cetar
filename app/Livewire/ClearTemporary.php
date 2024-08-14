<?php

namespace App\Livewire;

use App\Models\Temporary;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class ClearTemporary extends Component
{
    public function mount()
    {
        $this->clear();
    }
    public function clear()
    {

        $sessionId = Session::getId();
        $temporary = Temporary::where('session_id', $sessionId)->get();

        foreach ($temporary as $tmp)
        {
            Storage::delete($tmp->file);
            $tmp->delete();
        }

    }
    public function render()
    {
        return view('livewire.clear-temporary');
    }
}
