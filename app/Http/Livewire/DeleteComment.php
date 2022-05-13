<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Illuminate\Http\Response;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;


class DeleteComment extends Component
{
//    public  Comment $comment; the bug is here
    public  ?Comment $comment;
    protected $listeners=['setDeleteComment'];





    public function setDeleteComment($commentId)
    {

        $this->comment = Comment::findOrFail($commentId);

        $this->emit('deleteCommentWasSet');


    }

    public function deleteComment()
    {
        if (auth()->guest() || auth()->user()->cannot('delete',$this->comment))
        {
            abort(Response::HTTP_FORBIDDEN);
        }



        Comment::destroy($this->comment->id);

        if ($this->comment->image) 
        {
            Storage::delete($this->comment->image);
        }

        $this->comment=null;//we have to set it to null because after we deleting it with line 35 it still exist in $this->comment so we have to set it to null.... and the reason
        // why we add that "?" in 12 line its because the null cant be accepted as the value of that kinda variable so we make it optional for when we wanna set it to null

        $this->emit('commentWasDeleted');

//        return redirect(url()->previous());// find away to prevent refresh
    }
    public function render()
    {
        return view('livewire.delete-comment');
    }
}
