<div 

class="ml-2"
>
    {{-- Be like water. --}}
    {{-- reply button  --}}
    <div
        x-data="{isOpen:false}"
        {{-- @click.away="isOpen = false" --}}
        x-init="
            Livewire.on('commentWasAdded',() => {isOpen = false})
            Livewire.hook('message.processed', (message, component) =>
            {
{{--                pagination--}}
{{--            if(message.updateQueue[0].method == 'gotoPage' || message.updateQueue[0].method == 'nextPage' || message.updateQueue[0].method == 'previousPage')--}}
            if(['gotoPage','nextPage','previousPage'].includes(message.updateQueue[0].method))
            {

                const firstComment1=document.querySelector('.comment-container:first-child')
                firstComment1.scrollIntoView({behavior : 'smooth'})
            }

{{--                adding comment--}}
                if (['commentWasAdded'].includes(message.updateQueue[0].payload.event)
                    && message.component.fingerprint.name === 'idea-comments')
                {

                    const firstComment=document.querySelector('.comment-container:first-child')


                    firstComment.classList.add('bg-green-100')
                     firstComment.classList.remove('bg-white')
                    setTimeout(() =>
                    {
                    firstComment.classList.remove('bg-green-100')
                    firstComment.classList.add('bg-white')
                    },3000)
                }
            })


            {{-- going to the comment by notification     --}}
            @if(session('scrollToComment'))

            const commentToScrollTo=document.querySelector('#comment-{{session('scrollToComment')}}')


                    commentToScrollTo.classList.add('bg-green-100')
                     commentToScrollTo.classList.remove('bg-white')
                    setTimeout(() =>
                    {
                    commentToScrollTo.classList.remove('bg-green-100')
                    commentToScrollTo.classList.add('bg-white')
                    },3000)

            @endif
            "
        class='relative'>
        <button
            @click="
            isOpen = !isOpen 
            if(isOpen){ $nextTick(() => $refs.comment.focus())}"

            @keydown.escape.window="isOpen = false"
            type="button"

            class="flex items-center justify-center text-sm bg-blue-600 text-white font-semibold
                rounded-xl   hover:bg-blue-800 transition duration-150 ease-in
                px-12 py-2">
            کامنت
        </button>
        <div
        @click.away="isOpen = false"
            x-show="isOpen" x-transition.origin.top.left.duration.200ms style="display:none"
            class="absolute z-10 w-104 text-left font-semibold text-sm bg-white
                 shadow-md rounded-xl mt-2">
            @auth
            <form wire:submit.prevent="addComment" action="#" class="space-y-4 px-4 py-6">
                <div>
                            <textarea wire:model.defer="comment" x-ref="comment" name="post_comment" id="" cols="30" rows="4"
                                      class="w-full text-sm bg-gray-200 rounded-xl placeholder-gray-900
                            border-none px-4 py-2"
                                      placeholder="کامنت بزارین" required></textarea>

                    @error('comment')
                    <p class="text-red-600 tex-xs mt-1">
                        {{$message}}
                    </p>
                    @enderror
                </div>
                <div class="flex flex-col md:flex-row items-center ">
                    <button
                        type="submit"
                        class="flex items-center justify-center w-full md:w-1/2 h-11 text-sm bg-blue-600 text-white font-semibold
                            rounded-xl border border-blue-600 hover:border-blue-800 transition duration-150 ease-in
                            px-10 py-3">
                        کامنت
                    </button>
                    <div class="flex items-center justify-center w-1/2 h-11 text-xs bg-gray-200 mr-1.5
                        font-semibold rounded-xl border border-gray-200 hover:border-gray-400 
                        transition duration-150 ease-in">
                        <input class="hidden"  wire:model="commentImage" type="file" id="file2" >
                        <label for="file2"  class="w-full h-full px-3 flex items-center cursor-pointer"
                        >
                            <svg class="h-5 w-5 text-gray-600 mr-1 transform -rotate-45" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                            </svg>
                            <span>عکس بزار(اختیاری)</span>
                        </label>
                        </div>
                        
                    </div>
                    <div wire:loading wire:target="commentImage" class="text-right">بارگذاری...</div>
                    @if ($commentImage)
                    <div class="flex-col text-right">
                        <p class="text-right">اوکیه؟:</p>
                        <button wire:click="deleteCommentImage" type="button" class="px-2 py-2 my-2 text-white my-blue-delete rounded-lg "><i class="fa-solid fa-xmark"></i> حذف عکس</button>
                    </div>
                    <img class="h-24 w-24 rounded-lg" src="{{ $commentImage->temporaryUrl() }}">
                    {{-- <img class="h-24 w-24 rounded-lg" src="{{ auth()->user()->getAvatar() }}"> --}}
                    @endif
                    @error('commentImage')
                        <p class="text-red-600 tex-xs mt-1 text-right">
                            {{$message}}
                        </p>
                    @enderror
                    
            </form>
            @else
                <div class="space-y-4 px-4 py-6 text-right">
                    <p class="font-semibold">برای کامنت گذاشتن باید وارد شین😕</p>
                    <div class="flex items-center mt-2 md:mt-0 space-x-4">




                                <a 
                                wire:click.prevent="redirectToLogin"
                                href="{{ route('login') }}"
                                   class="flex items-center justify-center text-sm bg-gray-400 text-white font-semibold mx-2
                                     rounded-xl   hover:bg-gray-500 transition duration-150 ease-in
                                        px-12 py-2">وارد شین</a>


                                <a 
                                wire:click.prevent="redirectToRegister"
                                href="{{ route('register') }}"
                                   class="flex items-center justify-center text-sm bg-blue-600 text-white font-semibold
                                        rounded-xl   hover:bg-blue-800 transition duration-150 ease-in
                                    px-12 py-2">ثبت نام کنین</a>



                </div>
            @endauth
        </div>
    </div>
</div>
