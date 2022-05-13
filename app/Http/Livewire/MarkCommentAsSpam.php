<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Illuminate\Http\Response;
use Livewire\Component;

class MarkCommentAsSpam extends Component
{
    public  Comment $comment;
    protected $listeners=['setCommentMarkAsSpam'];





    public function setCommentMarkAsSpam($commentId)
    {

        $this->comment = Comment::findOrFail($commentId);

        $this->emit('markAsSpamCommentWasSet');


    }

    public function MarkCommentAsSpam()
    {
        if (auth()->guest())
        {
            abort(Response::HTTP_FORBIDDEN);
        }

        $this->comment->increment('spam_reports');
        $this->comment->save();
        $this->emit('commentWasMarkedAsSpam');

//        return redirect(url()->previous());// find away to prevent refresh
    }




    public function render()
    {
        return view('livewire.mark-comment-as-spam');
    }
}
