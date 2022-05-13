<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\WithAuthRedirects;
use Livewire\WithFileUploads;
use App\Models\Comment;
use App\Models\Idea;
use App\Notifications\CommentAdded;
use Illuminate\Http\Response;
use Livewire\Component;

class AddComment extends Component
{

    use WithFileUploads, WithAuthRedirects;
    public $idea;
    public $comment;
    public $commentImage;

    // protected $listeners = ['commentWasDeleted'];

    // public function commentWasDeleted()
    // {
    
    //     $this->commentImage=null;
    // }


    public function mount(Idea $idea)
    {

        $this->idea=$idea;
    }


    protected function rules()
    {
        return [
            'comment' => ['required','min:4'],
            'commentImage' =>['nullable','image','mimes:jpg,png,jpeg,gif','max:3072']
        ];
    }

    public function updatedCommentImage()

    {

        $this->validate([

            'commentImage' => ['nullable','image','mimes:jpg,png,jpeg,gif','max:3072'],

        ]);

    }


    public function deleteCommentImage()
    {
        $this->commentImage=null;
        $this->reset();
    }


    public function addComment()
    {



        if (auth()->guest())
        {
            abort(Response::HTTP_FORBIDDEN);
        }


        if (!auth()->user()->hasVerifiedEmail()) 
        {
            return redirect('verify-email');
        }


        $this->validate();


        $commentImages=$this->commentImage ? $this->commentImage->store('commentImages') : null;

        $newComment=Comment::create(
            [
               'user_id' => auth()->id(),
                'idea_id' => $this->idea->id,
                'status_id' =>1,
                'image' => $commentImages,
                'body' => $this->comment
            ]);



        $this->idea->user->notify(new CommentAdded($newComment));


        if (strpos(url()->previous(),"?comment=") && !strpos(url()->previous(),"?comment=1"))
        {
            redirect(explode('?',url()->previous())[0]);

            $this->reset('comment');

            $this->emit('commentWasAdded');
            $this->emit('refreshPage');
            $this->commentImage=null;
            $this->idea->refresh();


        }
        else
        {
            $this->reset('comment');
            $this->emit('commentWasAdded');
            $this->emit('refreshPage');
            $this->commentImage=null;
            $this->idea->refresh();
        }



    }


    public function render()
    {
        return view('livewire.add-comment');
    }
}
