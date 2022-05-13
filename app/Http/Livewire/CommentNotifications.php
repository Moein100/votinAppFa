<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\Idea;
use Illuminate\Http\Response;
use Illuminate\Notifications\DatabaseNotification;
use Livewire\Component;

class CommentNotifications extends Component
{
    const  NOTIFICATION_THRESHHOLD = 20;
    public $notifications;
    public $notificationCount;
    public $isLoading;
    protected $listeners=['getNotifications'];

    public function mount()
    {
        // we have to use this to say the notifications is empty untill the user click on notification button
        //if we dont do this the notifications is defined but there isnt really have anything
        $this->notifications=collect([]);
        $this->isLoading=true;
        $this->getNotificationsCount();
    }

    public function getNotificationsCount()
    {
        $this->notificationCount=auth()->user()->unreadNotifications()->count();
        if ($this->notificationCount > self::NOTIFICATION_THRESHHOLD)
        {
            $this->notificationCount =self::NOTIFICATION_THRESHHOLD.'+';
        }
    }

    public function getNotifications()
    {
        $this->notifications = auth()->user()->unreadNotifications()->latest()->take(self::NOTIFICATION_THRESHHOLD)->get();
        $this->isLoading=false;

    }

    public function markAsRead($notificationId)
    {
        $notfication=DatabaseNotification::findOrFail($notificationId);
        $notfication->markAsRead();
        $idea = Idea::find($notfication->data['idea_id']);
        $comment = Comment::find($notfication->data['comment_id']);


        if (!$idea)
        {
            session()->flash('error_message','این ایده حذف شده');
            return redirect()->route('idea.index');
        }


        if (!$comment)
        {
            session()->flash('error_message','این کامنت حذف شده');
            return redirect()->route('idea.index');
        }

        


        $comments = $idea->comments()->pluck('id');

        $indexOfComment = $comments->search($comment->id);

        $page= (int) ($indexOfComment / $comment->getPerPage())+1;

        session()->flash('scrollToComment',$comment->id);



        return redirect()->route('idea.show',[
            'idea' => $notfication->data['idea_id'],
            'slug' => $notfication->data['idea_slug'],
            'comment' => $page,
        ]);
    }


    public function markAllAsRead()
    {
        if (auth()->guest())
        {
            abort(Response::HTTP_FORBIDDEN);
        }
        auth()->user()->unreadNotifications->markAsRead();;
        $this->getNotificationsCount();
        $this->getNotifications();
    }

    public function render()
    {

        //before
//        return view('livewire.comment-notifications',
//            [
//                'notifications' => auth()->user()->unreadNotifications,
//            ]);


        //after    we send notifications by the public propery of notifications on line 10 when the user click on notifications button
        return view('livewire.comment-notifications');

    }
}
