<?php

namespace App\Jobs;

use App\Mail\IdeaStatusUpdateMailable;
use App\Models\Idea;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class NotifyAllVoters implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $backoff=10;
    public $tries=3;
    public $idea;
    public $user;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user,Idea $idea)
    {
        $this->idea = $idea;
        $this->user = $user;
    }  
    // public function __construct($user,$idea)
    // {
    //     $this->user = $user;
    //     $this->idea = $idea;
    // }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // dd('hello');
        // dump($this->user);
        // dump($this->idea);
        //    $voters=$this->idea->votes()->select('name','email')
        //  ->chunk(100,function ($voters)
        //  {
        //      foreach($voters as $user)
        //      {
        //          //send email
        //          Mail::to($user)->queue(new IdeaStatusUpdateMailable($this->idea));
        //      }
            
        //  });
        Mail::to($this->user->email)->send(new IdeaStatusUpdateMailable($this->idea));
        // dump('hello');
    }

   
}
