<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\Idea;
use Livewire\Component;
use Livewire\WithPagination;

class IdeaComments extends Component
{
    use WithPagination;
    public $idea;
    protected $listeners=[
        'commentWasAdded',
        'commentWasDeleted',
        'commentWasMarkedAsSpam',
        'statusWasUpdated',
        'refreshPage'=>'$refresh'];

    public function mount(Idea $idea)
    {
        $this->idea=$idea;

    }


    public function commentWasAdded()
    {
        $this->idea->refresh();
    }

    public function commentWasDeleted()
    {

        $this->idea->refresh();
        $this->gotoPage(1);
    }

    public function commentWasMarkedAsSpam()
    {

        $this->idea->refresh();

    }

    public function statusWasUpdated()
    {

        $this->idea->refresh();

    }



    public function render()
    {
        return view('livewire.idea-comments',
        [
//            i set perpage in paginate method to null so it can read the perpage from Comment model
            'comments' => $this->idea->comments()->paginate(null,['*'],"comment")->withQueryString()
        ]
        );
    }
}
