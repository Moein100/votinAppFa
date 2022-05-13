<div>
    {{-- The whole world belongs to you. --}}
    <div class="ideas-container space-y-6 my-6">
        <div onclick="GoToIdea(event)"   class="idea-container hover:shadow-md transition duration-150 ease-in bg-white rounded-xl flex cursor-pointer">
            {{-- 1 --}}
            <div class="hidden md:block border-r border-gray-100 px-5 py-8">
                <div class="text-center">
                    <div class="font-semibold text-2xl @if($hasVoted) text-blue-600 @endif ">
                        {{$votesCount}}
                    </div>
                    <div class="text-gray-500">
                         رای
                    </div>
                </div>

                @if($hasVoted)

                <div class="mt-8">
                    <button  wire:click.prevent="vote"
                    class="w-20 border-2 bg-blue-600 font-bold text-xs text-white border-blue-600 hover:border-blue-800
                    transition duration-150 ease-in
                    rounded-xl px-4 py-2">
                    رای دادم
                    </button>
                </div>
                @else
                <div class="mt-8">
                    <button  wire:click.prevent="vote"
                    class="w-20 border-2 bg-gray-300 font-bold text-xs text-white border-gray-300 hover:border-gray-500
                    transition duration-150 ease-in
                    rounded-xl px-4 py-2">
                    رای میدم
                    </button>
                </div>
                @endif
            </div>
            {{-- 2 --}}
            <div class="flex flex-col md:flex-row flex-1 px-3 py-6">

                <a href="" class="flex-none w-14 h-14 mx-2 md:mx-0">
                    <img src="{{$idea->user->getAvatar()}}" alt="avatar" class="w-14 h-14 rounded-xl">
                </a>
                <div class="w-full mx-4 flex flex-col justify-between">
                    <h4 class="text-xl font-semibold mt-2 md:mt-0">
                        <a href="{{route('idea.show',$idea)."/".$idea->slug}}" class="idea-link hover:underline">{{$idea->title}}</a>
                    </h4>
                    <div class="text-gray-600 mt-3 line-clamp-3">
                        @admin
                        @if($idea->spam_reports > 0)
                        <div class="text-white w-1/2 text-center px-4 py-0.5 bg-red-500 rounded-full mb-2">Spam reports : {{$idea->spam_reports}}</div>
                        @endif
                        @endadmin
                        {{$idea->description}}
                    </div>
                    <div class="flex flex-col md:flex-row md:items-center justify-between mt-6">
                        <div class="flex items-center md:text-xs text-xxs font-semibold space-x-2 text-gray-300">
                            <div class="ml-1.5">{{$idea->created_at->diffForHumans()}}</div>
                            <div>&bull;</div>
                            <div>{{$idea->category->name}}</div>
                            <div>&bull;</div>
                            <div wire:ignore class="text-gray-800">{{$idea->comments_count}} نظر</div>
                        </div>
                        <div
                        class="flex items-center space-x-2 mt-4 md:mt-0"
                        x-data="{isOpen:false}">
                            <span class="{{'status-'.Str::kebab($idea->status->name)}} text-xxs font-bold uppercase leading-none rounded-full text-center  px-7 py-1">
                                {{$idea->status->name}}
                            </span>
{{--                            <button --}}
{{--                            @click="isOpen = !isOpen"--}}
{{--                            @click.away="isOpen = false"--}}
{{--                            @keydown.escape.window="isOpen = false"--}}
{{--                            class="bg-gray-200 text-xxs hover:bg-gray-400 rounded-full py-1 px-4 transition duration-150 ease-in "--}}
{{--                            >--}}
{{--                                <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">--}}
{{--                                    <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />--}}
{{--                                </svg>--}}
{{--                                <ul--}}
{{--                                x-show="isOpen" x-transition.origin.top.left.duration.200ms  --}}
{{--                                class="absolute w-44 font-semibold text-sm bg-white shadow-lg rounded-xl py-3 md:ml-8  -ml-11" style="display : none">--}}
{{--                                    <li><a href="" class="hover:bg-gray-200 px-5 py-3 block transition duration-150 ease-in"> Mark as smap</a></li>--}}
{{--                                    <li><a href="" class="hover:bg-gray-200 px-5 py-3 block transition duration-150 ease-in"> Delete Post</a></li>--}}
{{--                                </ul>--}}
{{--                            </button>--}}
                        </div>




                        <div class="flex items-center mt-4 ml-auto  md:mt-0 md:hidden" dir="ltr">
                            <div class="bg-gray-200 text-center rounded-xl h-10 py-2 pl-3 pr-8">
                                <div class="text-sm font-bold leading-none @if($hasVoted) text-blue-600 @endif ">{{$votesCount}}</div>
                                <div class="text-xxs font-semibold leading-none text-gray-500">رای</div>
                            </div>
                            @if($hasVoted)
                            <button wire:click.prevent="vote"
                            class="w-20 bg-blue-600 font-bold text-xxs text-white
                            uppercase rounded-xl hover:bg-blue-600 transition duration-150 ease-in px-4 py-3
                            -mx-6">
                                رای دادم 
                            </button>
                            @else
                            <button wire:click.prevent="vote"
                            class="w-20 bg-gray-300 font-bold text-xxs
                            uppercase rounded-xl hover:bg-gray-500 transition duration-150 ease-in px-4 py-3
                            -mx-6">
                                رای میدم
                            </button>
                            @endif
                        </div>



                    </div>
                </div>

            </div>
        </div>
      </div>
</div>
