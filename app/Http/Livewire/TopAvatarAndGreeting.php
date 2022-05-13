<?php

namespace App\Http\Livewire;

use Livewire\Component;

class TopAvatarAndGreeting extends Component
{
    protected $listeners = ['profileWasUpdated'=>'$refresh'];

    


    public function render()
    {
        return view('livewire.top-avatar-and-greeting');
    }
}
