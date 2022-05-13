@component('mail::message')

    {{$comment->author->name}}  commented On your idea:

    **{{$comment->idea->title}}**

    Comment : {{$comment->body}}

@component('mail::button', ['url' => route('idea.show',$comment->idea)."/".$comment->idea->slug])
Go to Idea
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
