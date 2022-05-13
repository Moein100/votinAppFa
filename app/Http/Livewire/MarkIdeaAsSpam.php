<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use Illuminate\Http\Response;
use Livewire\Component;

class MarkIdeaAsSpam extends Component
{

    public $idea;

    public function mount(Idea $idea)
    {
        $this->idea=$idea;
    }


    public function markAsSpam()
    {
        if (auth()->guest())
        {
            abort(Response::HTTP_FORBIDDEN);
        }
        if (!auth()->user()->hasVerifiedEmail()) 
        {
            return redirect('verify-email');
        }
        session()->reflash();

        $this->idea->increment('spam_reports');
        $this->idea->save();

        $this->emit('ideaWasMarkedAsSpam');








        $this->emit('refreshPage');


    }

    public function render()
    {
        return view('livewire.mark-idea-as-spam');
    }
}
