{{-- these modals are belong to idea-show page --}}

@can('update',$idea)
    <livewire:edit-idea :idea="$idea"/>
@endcan
@can('delete',$idea)
    <livewire:delete-idea :idea="$idea"/>
@endcan

@auth
    <livewire:mark-idea-as-spam :idea="$idea"/>
@endauth
@admin
    <livewire:mark-idea-as-not-spam :idea="$idea"/>
@endadmin


@auth
<livewire:edit-comment/>

    <livewire:delete-comment/>

    <livewire:mark-comment-as-spam/>

    <livewire:mark-comment-as-not-spam/>
    
    
    
@endauth