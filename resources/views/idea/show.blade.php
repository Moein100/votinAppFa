<x-app-layout>

    <x-slot name="title">
        {{$idea->title}} | BC Voting
    </x-slot>

    <div>
        <a href="{{url()->previous()}}"
        class="hidden md:flex items-center justify-end font-semibold hover:underline">
        <span class="ml-2">بازگشت</span>
            <svg  class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
        </a>
    </div>





    <livewire:idea-show :idea="$idea" :votesCount="$votesCount"/>

    <livewire:idea-comments :idea="$idea"/>



    <x-ideas-modals-container :idea="$idea"/>
</x-app-layout>
