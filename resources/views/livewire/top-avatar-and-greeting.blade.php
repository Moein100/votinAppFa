<div>
    {{-- The whole world belongs to you. --}}
    <a x-init @click.prevent="$dispatch('custom-show-edit-profile-modal')" href="" classs="mx-2"><img
        class="w-10 h-10 rounded-full"
         src="{{auth()->user()->getAvatar()}}"
          alt="avatar"></a>

       
</div>
