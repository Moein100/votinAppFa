<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\WithAuthRedirects;
use App\Models\Idea;
use Livewire\Component;

class IdeaIndex extends Component
{
    use WithAuthRedirects;

    public $idea;
    public $votesCount;
    public $hasVoted;

    protected $listeners =['profileWasUpdated'];


    public function profileWasUpdated()
    {
        $this->idea->refresh();
    }


    public function mount(Idea $idea,$votesCount)
    {
        $this->idea=$idea;
        $this->votesCount=$votesCount;
        // $this->hasVoted = $idea->isVotedByUser(auth()->user());
        $this->hasVoted = $idea->voted_by_user;
    }

    public function vote()
    {
        if(auth()->guest())
        {
            return  $this->redirectToLogin();

        }

        if (!auth()->user()->hasVerifiedEmail()) 
        {
            return redirect('verify-email');
        }


        if ($this->hasVoted) 
        {
            $this->idea->removeVote(auth()->user());
            $this->votesCount--;
            $this->hasVoted = false;
        }else
        {
            $this->idea->vote(auth()->user());
            $this->votesCount++;
            $this->hasVoted = true;
        }
    }

    public function render()
    {
        return view('livewire.idea-index');
    }

    
}
