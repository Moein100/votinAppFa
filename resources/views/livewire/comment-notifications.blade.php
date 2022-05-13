
    {{-- Do your work, then step back. --}}
    <div
        x-data="{isOpen:false}"
        class="relative"
        wire:poll="getNotificationsCount"

    >
        <button @click="
        isOpen=!isOpen
        if(isOpen)
        {
            Livewire.emit('getNotifications')
        }
">
            <svg  class="h-8 w-8 text-gray-400 hover:text-gray-700 transition duration-150 ease-in " fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
            @if($notificationCount > 0)
                <div class="absolute rounded-full bg-red-500 text-xxs w-6 h-6 flex justify-center items-center -right-1 -top-1 text-white">
                    {{$notificationCount}}</div>
            @endif
        </button>

        <ul
{{--            @click="isOpen = !isOpen"--}}
            @click.away="isOpen = false"
            @keydown.escape.window="isOpen = false"
            x-show="isOpen" x-transition.origin.top.left.duration.200ms
            class="absolute z-20 w-76 md:w-96 max-h-96 overflow-y-auto  text-sm bg-white shadow-lg rounded-xl py-3 -left-40 md:-left-12 " style="display : none;">

            @if($notifications->isNotEmpty() && ! $isLoading)

            @foreach($notifications as $notification)
            <li>

                <a
                    @click="isOpen = false"
                    wire:click.prevent="markAsRead('{{$notification->id}}')"
                    href="{{route('idea.show',$notification->data['idea_id'])."/".$notification->data['idea_slug']}}"
{{--                    we dont need the href part because we prevent the reload on line 38 so we gonna redirect user in markAsRead method--}}
                   class=" flex hover:bg-gray-200 px-5 py-3 transition duration-150 ease-in">
                   
                    <img class="rounded-xl w-10 h-10" src="{{$notification->data['user_avatar']}}" />
                    <div class="mr-4">
                        <div>
                            <span class="font-semibold ">{{$notification->data['user_name']}}</span>
                            <span>روی</span>
                            <span class="font-semibold">"{{$notification->data['idea_title']}}"</span>
                            <span>کامنت گذاشت</span>
                            <span class="">{{$notification->data['comment_body']}}</span>
                        </div>
                        <div class="text-gray-400">{{$notification->created_at->diffForHumans()}}</div>
                    </div>
                </a>
            </li>
            @endforeach
            <li class="border-t border-gray-400 text-center font-bold hover:bg-gray-200 py-2 transition duration-150 ease-in">
                <button
                    @click="isOpen = false"

                    wire:click="markAllAsRead"
                    class="font-bold">
                    همه رو خوندم
                </button>
            </li>
            @elseif($isLoading)
              @foreach(range(1,3) as $item)
                    <li class="animate-pulse flex items-center transition duration-150 ease-in px-5 py-3">
                        <div class="bg-gray-300 rounded-xl w-10 h-10"></div>
                        <div class="flex-1 ml-4 space-y-2">
                            <div class="bg-gray-200 w-full rounded h-3"></div>
                            <div class="bg-gray-200 w-full rounded h-3"></div>
                            <div class="bg-gray-200 w-1/2 rounded h-3"></div>
                        </div>
                    </li>
              @endforeach
            @else
                <li class="mx-auto w-70 mb-4">
                    <div class="text-gray-400 text-center font-bold mt-6">
                        پیامی نداری!
                    </div>
                </li>
             @endif
        </ul>




    </div>

