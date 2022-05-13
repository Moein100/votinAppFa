@component('mail::message')
# idea Status updated

the idea: {{$idea->title}}

{{$idea->status->name}}

@component('mail::button', ['url' => route('idea.show',$idea->id).$idea->slug, 'title' => $idea->slug])
view Idea
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
