<div>
    {{-- The whole world belongs to you. --}}
    <div
        x-data="{isOpen:false}"
        x-show="isOpen"
        @keydown.escape.window="isOpen = false"
{{--        @custom-show-edit-modal.window="--}}
{{--isOpen = true--}}
{{--$nextTick(() => $refs.title.focus())--}}
{{--"--}}
        x-init="
        Livewire.on('commentWasUpdated', () => { isOpen = false})
        Livewire.on('editCommentWasSet',() =>
        {
            isOpen = true
            $nextTick(() => $refs.comment.focus())
        })
"
        x-transition.origin.bottom.duration.400ms
        class=" fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" style="display: none">
        <div class="flex items-end justify-center min-h-screen ">
            <!--
              Background overlay, show/hide based on modal state.

              Entering: "ease-out duration-300"
                From: "opacity-0"
                To: "opacity-100"
              Leaving: "ease-in duration-200"
                From: "opacity-100"
                To: "opacity-0"
            -->
            <div
                x-transition.origin.bottom.duration.500ms
                class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>


            <!--
              Modal panel, show/hide based on modal state.

              Entering: "ease-out duration-300"
                From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                To: "opacity-100 translate-y-0 sm:scale-100"
              Leaving: "ease-in duration-200"
                From: "opacity-100 translate-y-0 sm:scale-100"
                To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            -->
            <div
                x-transition.origin.bottom.duration.500ms
                class="modal  bg-white rounded-tl-xl rounded-tr-xl  overflow-hidden shadow-xl transform transition-all py-4  sm:max-w-lg sm:w-full">

                <div class="absolute top-0 right-0 pt-4 pr-4">
                    <button
                        @click="isOpen = false"
                        class="text-gray-400 hover:text-gray-500">
                        <svg  class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>


                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-center text-lg font-bold text-gray-700">ویرایش</h3>
{{--                    <p class="text-xs text-center leading-5 text-gray-700 mt-4 px-6">--}}
{{--                        you have 1 hour to edit your idea from the time you created it.--}}
{{--                    </p>--}}
                    <form wire:submit.prevent="updateComment" action="" method="POST" class="space-y-4 py-6">
                        <div>
                <textarea wire:model.defer="body" x-ref="comment" name="idea" id="idea" cols="30" rows="4" placeholder="add you idea"
                          class="w-full bg-gray-200 rounded-xl placeholder-gray-500 text-sm px-4 py-2 border-none"></textarea>
                            @error('body')
                            <p class="text-red-600 tex-xs mt-1">
                                {{$message}}
                            </p>
                            @enderror
                        </div>
                        <div class="flex items-center justify-between space-x-3">
                            {{-- <button type="button"
                                    class="flex items-center justify-center w-1/2 h-11 text-xs bg-gray-200
                font-semibold rounded-xl border border-gray-200 hover:border-gray-400
                transition duration-150 ease-in">
                                <svg class="h-5 w-5 text-gray-600 mr-1 transform -rotate-45" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                </svg>
                                <span> Attach</span>
                            </button> --}}


                            <button type="submit"
                                    class="flex submit-blue  items-center justify-center w-full h-11 text-xs text-white
                font-semibold rounded-xl border-2 border-blue-600 hover:border-blue-800
                transition duration-150 ease-in">
                                <span>ویرایش</span>
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
