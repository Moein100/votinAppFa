<?php

namespace App\Notifications;

use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CommentAdded extends Notification implements ShouldQueue
{
    use Queueable;
    public $comment;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($comment)
    {
        $this->comment=$comment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        // return ['database','mail'];
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('hello')
            ->from('mkfprojects00@gmail.com', 'Basu Connections')
            ->markdown('emails.comment-added',
                [
                    'comment'=>$this->comment,
                ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {

        return [
            'comment_id' => $this->comment->id,
            'comment_body' => $this->comment->body,
            'user_avatar' => $this->comment->author->getAvatar(),
            'user_name' => $this->comment->author->name,
            'idea_id' => $this->comment->idea->id,
            'idea_slug'=> $this->comment->idea->slug,
            'idea_title' => $this->comment->idea->title
        ];
    }



}
