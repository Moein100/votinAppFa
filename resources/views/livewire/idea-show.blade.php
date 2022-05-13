
<div>
    <div class="ideas-container space-y-6 my-6">
        <div class="idea-container  bg-white rounded-xl flex ">
            {{-- 1 --}}

            {{-- 2 --}}
            <div class="flex flex-col md:flex-row flex-1 px-3 py-6">
                <div class="flex-none mx-2 md:mx-0">
                    <a href="" ><img src="{{$idea->user->getAvatar()}}" alt="avatar" class="w-14 h-14 rounded-xl"></a>
                    <div class="font-bold text-gray-900 mr-2">{{$idea->user->name}}</div>
                </div>
                <div class="w-full mx-4">
                    <h4 class="text-xl font-semibold mt-2 md:mt-0">
                        {{$idea->title}}
                    </h4>
                    <div class="text-gray-600 mt-3 idea-show-links-blue">
                        @admin
                        @if($idea->spam_reports > 0)
                            <div class="text-white w-1/2 text-center px-4 py-0.5 bg-red-500 rounded-full mb-2">Spam reports : {{$idea->spam_reports}}</div>
                        @endif
                        @endadmin
                        {{-- {!!nl2br(e($idea->description))!!} --}}
                        @php
                        $url = '@(http)?(s)?(://)?(([a-zA-Z])([-\w]+\.)+([^\s\.]+[^\s]*)+[^,.\s])@';
                        $string = preg_replace($url, '<a href="http$2://$4" target="_blank" title="$0">$0</a>', nl2br(e($idea->description)));
                        
                        @endphp
                        {!!$string!!}
                    </div>
                    @if($idea->image)
                    <div class="mt-16 w-full flex justify-center">
                        <img class="rounded-lg max-h-48 max-w-48" src="{{asset("/app/".$idea->image)}}" alt="{{$idea->name}}">
                    </div>
                    @endif
                    <div class="flex flex-col lg:flex-row  justify-between mt-6">
                        <div class="flex items-center md:text-xs text-xxs font-semibold space-x-2 text-gray-300">
                            
                            
                            <div class="ml-1.5">{{$idea->created_at->diffForHumans()}}</div>
                            <div>&bull;</div>
                            <div>{{$idea->category->name}}</div>
                            <div>&bull;</div>
{{--                            <div class="text-gray-800">{{$idea->comments->count()}} comments</div>--}}
                            <div class="text-gray-800">{{$idea->comments()->count()}} نظر</div>
                        </div>
                        <div
                            class="flex items-center space-x-2 mt-4 lg:mt-0 md:justify-between"
                            x-data="{isOpen:false}">
                            @auth
                                <div class="relative ml-2">

                                    <button
                                    @click="isOpen = !isOpen"
                                    @click.away="isOpen = false"
                                    @keydown.escape.window="isOpen = false"
                                    class="bg-gray-200 text-xxs hover:bg-gray-400 rounded-full py-1 px-4 transition duration-150 ease-in "
                                    >
                                        <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                        </svg>
                                    </button>
                                    <ul
                                    x-show="isOpen" x-transition.origin.top.left.duration.200ms
                                    class="absolute z-20 w-44 font-semibold text-sm bg-white shadow-lg rounded-xl py-3   lg:ml-8  -ml-36" style="display : none">

                                        @can('update',$idea)
                                            <li><a href=""
                                            @click.prevent="$dispatch('custom-show-edit-modal')"
                                            class="hover:bg-gray-200 px-5 py-3 block transition duration-150 ease-in"> ویرایش</a></li>
                                        @endcan
                                        @can('delete',$idea)
                                        <li><a href=""
                                               @click.prevent="$dispatch('custom-show-delete-modal')"
                                               class="hover:bg-gray-200 px-5 py-3 block transition duration-150 ease-in"> حذف</a></li>
                                        @endcan
                                        <li><a
                                                @click.prevent="$dispatch('custom-show-spam-modal')"
                                                href="" class="hover:bg-gray-200 px-5 py-3 block transition duration-150 ease-in"> اسپم کردن</a></li>
                                        @admin
                                        @if($idea->spam_reports > 0)
                                        <li><a
                                                @click.prevent="$dispatch('custom-show-not-spam-modal')"
                                                href="" class="hover:bg-gray-200 px-5 py-3 block transition duration-150 ease-in"> Not spam</a></li>
                                        @endif
                                        @endadmin
                                    </ul>
                                </div>
                            @endauth
                                <div class="{{'status-'.Str::kebab($idea->status->name)}} text-xxs font-bold uppercase leading-none rounded-full text-center  px-7 py-1">
                                    {{$idea->status->name}}
                                </div>
                            
                            </div>


                            {{-- <div class="flex items-center mt-4 md:mt-0 md:hidden ">
                                <div class="bg-gray-200 text-center rounded-xl h-10 py-2 pl-3 pr-8">
                                    <div class="text-sm font-bold leading-none @if($hasVoted) text-blue-600 @endif">{{$votesCount}}</div>
                                    <div class="text-xxs font-semibold leading-none text-gray-500">Votes</div>
                                </div>
                                @if ($hasVoted)
                                <button wire:click.prevent="vote"
                                class="w-20 bg-blue-600 font-bold text-xxs text-white
                                uppercase rounded-xl hover:bg-blue-500 transition duration-150 ease-in px-4 py-3
                                -mx-6">
                                    Voted
                                </button>
                                @else
                                <button wire:click.prevent="vote"
                                class="w-20 bg-gray-300 font-bold text-xxs
                                uppercase rounded-xl hover:bg-gray-500 transition duration-150 ease-in px-4 py-3
                                -mx-6">
                                    Vote
                                </button>
                                @endif
                            </div> --}}


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
      {{-- end Ideas --}}

      {{-- buttons  --}}
      <div class="buttons-container md:flex items-center justify-between mt-6">
        <div class="flex flex-col md:flex-row items-center justify-center md:space-x-4">

            <livewire:add-comment :idea="$idea"/>


{{--        --}}{{-- set status button --}}
{{--        @auth--}}
{{--            @if(auth()->user()->isAdmin())--}}
{{--                <livewire:set-status :idea="$idea"/>--}}
{{--            @endif--}}
{{--        @endauth--}}
{{--            --}}{{-- end set status --}}

{{--            custom blade 'admin'--}}

            @admin
            <livewire:set-status :idea="$idea"/>
            @endadmin

        </div>



        <div class="hidden md:flex items-center justify-center">



            @if ($hasVoted)
            <button wire:click.prevent="vote" type="button"
            class="flex items-center justify-between px-10 py-3 text-xs ml-2 bg-blue-600 text-white
            font-bold rounded-xl border border-blue-600 hover:border-blue-800
            transition duration-150 ease-in">
                <span>رای دادم</span>
            </button>
            @else
            <button wire:click.prevent="vote" type="button"
            class="flex items-center justify-between px-10 py-3 text-xs ml-2 bg-gray-200
            font-bold rounded-xl border border-gray-200 hover:border-gray-400
            transition duration-150 ease-in">
                <span>رای میدم</span>
            </button>
            @endif




            {{-- @if ($hasVoted)
            <button type="button"
            class="flex items-center justify-between px-10 py-3 text-xs bg-gray-200
            font-bold rounded-xl border border-gray-200 hover:border-gray-400
            transition duration-150 ease-in">
                <span>VOTE</span>
            </button>
            @else
            <button type="button"
            class="flex items-center justify-between px-10 py-3 text-xs bg-blue-600
            font-bold rounded-xl border border-blue-600 hover:border-blue-800
            transition duration-150 ease-in">
                <span>VOTED</span>
            </button>
            @endif --}}
            <div class="bg-white font-semibold text-center rounded-xl px-4 py-0.5">
                <div class="text-xl leading-snug @if($hasVoted) text-blue-600 @endif">{{$votesCount}}</div>
                <div class="text-gray-500 text-xs leading-none">رای</div>
            </div>
        </div>
      </div>
      {{-- end of buttons --}}


</div>
