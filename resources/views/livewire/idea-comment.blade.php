
    {{-- Nothing in the world is as soft and yielding as water. --}}
    <div id="comment-{{$comment->id}}" class="@if($comment->is_status_update) is-status-update  {{'status-'.Str::kebab($comment->status->name)}}@endif comment-container relative bg-white rounded-xl flex transition duration-500 ease-in">

        <div class="flex flex-1 px-2 py-6">
            <div class="flex-none mx-2 md:mx-0">
                <a href="" ><img src="{{$comment->author->getAvatar()}}" alt="avatar" class="w-14 h-14 rounded-xl"></a>
                @if($comment->author->isAdmin())
                    <div class="text-center uppercase text-blue-600 text-xxs font-bold mt-1">
                        Admin
                    </div>
                @endif
            </div>

            <div class="w-full md:mx-4">
                {{-- <h4 class="text-xl font-semibold">
                    <a href="#" class="hover:underline">A random title can go here</a>
                </h4> --}}
                <div class="text-gray-600 mt-3">
                    @admin
                    @if($comment->spam_reports > 0)
                        <div class="text-white w-1/2 text-center px-4 py-0.5 bg-red-500 rounded-full mb-2">Spam reports : {{$comment->spam_reports}}</div>
                    @endif
                    @endadmin
                    @if($comment->is_status_update)
                    <h4 class="text-xl font-semibold mb-2">
                        وضعیت این پست به "{{$comment->status->name}}" تغییر کرد
                    </h4>
                    @endif
                    <div>
                        {{-- {!!nl2br(e($comment->body))!!} --}}

                        @php
                        $url = '@(http)?(s)?(://)?(([a-zA-Z])([-\w]+\.)+([^\s\.]+[^\s]*)+[^,.\s])@';
                        $string = preg_replace($url, '<a href="http$2://$4" target="_blank" title="$0">$0</a>', nl2br(e($comment->body)));
                        
                        @endphp
                        {!!$string!!}
                    </div>
                    @if ($comment->image)
                    <div class="mt-4 w-full flex justify-center">
                        <img class="rounded-lg max-h-48 max-w-48" src="{{asset("/app/".$comment->image)}}" alt="commentImage">
                    </div>
                    @endif
                </div>
                <div class="flex  md:items-center justify-between mt-6">
                    <div class="flex items-center md:text-xs text-xxs font-semibold space-x-2 text-gray-300">
                        <div class="@if($comment->is_status_update) text-blue-600 @else text-gray-900 @endif font-bold  ">{{$comment->author->name}}</div>
                        <div>&bull;</div>
                        <div>{{$comment->created_at->diffForHumans()}}</div>
                        <div>&bull;</div>
{{--                        @if($comment->user->id == $comment->idea->user->id)--}}

                        @if($comment->author->id == $ideaUserId)
                        <div class="rounded-full border bg-gray-200 text-gray-600 px-3 py-1">OP</div>
                        @endif
                    </div>

                    @auth
                    <div
                        class="flex items-center space-x-2 "
                        x-data="{isOpen:false}">
                        <div class="hidden bg-gray-200 text-xxs font-bold uppercase leading-none rounded-full text-center  px-7 py-1">
                            Open
                        </div>
                        <button
                            @click="isOpen = !isOpen"
                            @click.away="isOpen = false"
                            @keydown.escape.window="isOpen = false"
                            class="bg-gray-200 text-xxs hover:bg-gray-400 rounded-full py-1 px-4 transition duration-150 ease-in "
                        >
                            <svg class="h-4 w-4 text-gray-600" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                            </svg>
                            <ul
                                x-show="isOpen" x-transition.origin.top.left.duration.200ms
                                class="absolute z-40 w-44 font-semibold text-sm bg-white shadow-lg rounded-xl py-3   md:ml-8  -ml-36" style="display : none">
                                @can('update',$comment)
                                <li><a href=""
                                       @click.prevent="
{{--                                       $dispatch('custom-show-edit-modal')--}}
                                           Livewire.emit('setEditComment',{{$comment->id}})
                                        "
                                       class="hover:bg-gray-200 px-5 py-3 block transition duration-150 ease-in text-gray-600"> ویرایش</a></li>
                                @endcan
                                @can('delete',$comment)
                                        <li><a href=""
                                               @click.prevent="

                                                   Livewire.emit('setDeleteComment',{{$comment->id}})
                                        "


                                               class="hover:bg-gray-200 px-5 py-3 block transition duration-150 ease-in text-gray-600"> حذف</a></li>
                                @endcan

                                    <li><a href=""
                                           @click.prevent="

                                                   Livewire.emit('setCommentMarkAsSpam',{{$comment->id}})
                                        "


                                           class="hover:bg-gray-200 px-5 py-3 block transition duration-150 ease-in text-gray-600 " > اسپم</a></li>
                                @admin
                                    <li><a href=""
                                           @click.prevent="

                                                   Livewire.emit('setCommentMarkAsNotSpam',{{$comment->id}})
                                        "


                                           class="hover:bg-gray-200 px-5 py-3 block transition duration-150 ease-in text-gray-600"> Mark as not spam</a></li>
                                @endadmin
                            </ul>
                        </button>
                    </div>
                    @endauth
                </div>
            </div>

        </div>
    </div>

