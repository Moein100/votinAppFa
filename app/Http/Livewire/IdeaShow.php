<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\WithAuthRedirects;
use App\Models\Idea;
use Livewire\Component;

class IdeaShow extends Component
{
    use WithAuthRedirects;
    public $idea;
    public $votesCount;
    public $hasVoted;

    protected $listeners = [
        'statusWasUpdated',
        'IdeaWasUpdated',
        'ideaWasMarkedAsSpam',
        'ideaWasMarkedAsNotSpam',
        'commentWasAdded',
        'refreshPage' => '$refresh',
        "profileWasUpdated"

    ];

    public function mount(Idea $idea,$votesCount)
    {
        $this->idea=$idea;
        $this->votesCount=$votesCount;
        $this->hasVoted = $idea->isVotedByUser(auth()->user());
        // $this->hasVoted = $idea->voted_by_user; this line is just for the index page because we have subquery (addSelect) just on that page
    }


    public function profileWasUpdated()
    {
        $this->idea->refresh();
    }

    public function statusWasUpdated()
    {
        $this->idea->refresh();
    }

    public function IdeaWasUpdated()
    {
        $this->idea->refresh();
    }

    public function ideaWasMarkedAsSpam()
    {
        $this->idea->refresh();
    }

    public function commentWasAdded()
    {
        $this->idea->refresh();
    }

    public function ideaWasMarkedAsNotSpam()
    {

        $this->idea->refresh();
    }


    public function vote()
    {
        if(auth()->guest())
        {
            // redirect()->setIntendedUrl(url()->previous());



            // return redirect()->route('login');


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
        return view('livewire.idea-show');

    }
}
