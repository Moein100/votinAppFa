<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Illuminate\Http\Response;
use Livewire\Component;

class MarkCommentAsNotSpam extends Component
{
    public  Comment $comment;
    protected $listeners=['setCommentMarkAsNotSpam'];





    public function setCommentMarkAsNotSpam($commentId)
    {

        $this->comment = Comment::findOrFail($commentId);

        $this->emit('markAsNotSpamCommentWasSet');


    }

    public function MarkCommentAsNotSpam()
    {
        if (auth()->guest())
        {
            abort(Response::HTTP_FORBIDDEN);
        }

        $this->comment->spam_reports=0;
        $this->comment->save();
        $this->emit('commentWasMarkedAsNotSpam');

//        return redirect(url()->previous());// find away to prevent refresh
    }



    public function render()
    {
        return view('livewire.mark-comment-as-not-spam');
    }
}
