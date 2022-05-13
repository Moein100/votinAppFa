<?php

namespace App\Http\Livewire;

use App\Jobs\NotifyAllVoters;
// use App\Mail\IdeaStatusUpdateMailable;
use App\Models\Comment;
use App\Models\Idea;
use Illuminate\Http\Response;
// use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use App\Notifications\CommentAdded;

class SetStatus extends Component
{

    public $idea;

    public $status;

    public $notifyAllVoters;

    public $comment;

    public function mount(Idea $idea)
    {
        $this->idea=$idea;
        $this->status= $this->idea->status_id;
    }


    public function setStatus()
    {
        if (!auth()->check() || !auth()->user()->isAdmin())
        {
            abort(Response::HTTP_FORBIDDEN);
        }


        if ($this->idea->status_id == $this->status) 
        {
            $this->emit('statusWasUpdated');
            return;
        }



        $this->idea->status_id = $this->status;
        $this->idea->save();



        if ($this->notifyAllVoters)
        {
            $voters=$this->idea->votes()->select('name','email')
         ->chunk(100,function ($voters)
         {
             foreach($voters as $user)
             {
                 //send email
                NotifyAllVoters::dispatch($user,$this->idea)->delay(2);
         }});


                // NotifyAllVoters::dispatch($this->idea);

        }

        $newComment=Comment::create(
            [
                'user_id' => auth()->id(),
                'idea_id' => $this->idea->id,
                'status_id' =>$this->status,
                'body' => $this->comment ?? 'No Comment was Added',
                'is_status_update' => true,
            ]);

        $this->idea->user->notify(new CommentAdded($newComment));    

        $this->reset('comment');

        $this->emit('statusWasUpdated');



    }


    // public function notifyAllVoters()
    // {
    //     // $voters=$this->idea->votes()->select('name','email')->get();

    //     // foreach($voters as $user)
    //     // {
    //     //     // send email
    //     // }

    //     // the code below is for the time that we have more than 100 voters so we cant notify all of them at once

    //     //  $voters=$this->idea->votes()->select('name','email')
    //     //  ->chunk(100,function ($voters)
    //     //  {
    //     //      foreach($voters as $user)
    //     //      {
    //     //          //send email
    //     //          Mail::to($user)->queue(new IdeaStatusUpdateMailable($this->idea));
    //     //      }

    //     //  });





    // }

    public function render()
    {
        return view('livewire.set-status');
    }
}
