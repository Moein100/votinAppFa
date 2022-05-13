  {{-- In work, do what you enjoy. --}}

  <div
  
 
  >
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}

<div
x-data="{isOpen:false}"
x-show="isOpen"
@keydown.escape.window="
isOpen = false
Livewire.emit('editProfileWasClosed')
"
@custom-show-edit-profile-modal.window="
isOpen = true
$nextTick(() => $refs.name.focus())
"


x-init="Livewire.on('profileWasUpdated', () => { isOpen = false})"
x-transition.origin.bottom.duration.400ms
class=" fixed z-50 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" style="display: none">
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
      @click.away="isOpen = false
      Livewire.emit('editProfileWasClosed')"
      x-transition.origin.bottom.duration.500ms
      class="modal  bg-white rounded-tl-xl rounded-tr-xl  overflow-hidden shadow-xl transform transition-all py-4  sm:max-w-lg sm:w-full">

        <div class="absolute top-0 right-0 pt-4 pr-4">
          <button
          @click="
          isOpen = false
          Livewire.emit('editProfileWasClosed')
          "
          class="text-gray-400 hover:text-gray-500">
            <svg  class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>


        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
          <h3 class="text-center text-lg font-bold text-gray-700">ویرایش پروفایل</h3>
          
          <form wire:submit.prevent="updateProfile" action="" method="POST" class="space-y-4 py-6">


            <div class="flex flex-col">
                <label class="block text-sm font-medium text-gray-700"> عکس پروفایلتون اینه: </label>
                <div class="mt-1 flex-col items-center ">
                  {{-- <div class="mt-1 flex items-center "> --}}

                  <div class="flex mt-2">
                  <span class=" h-12 w-12 rounded-full overflow-hidden bg-gray-100">
                    <img src="{{auth()->user()->getAvatar()}}" alt=""/>
                  </span>
                  
                  
                  
                  {{-- <button type="button" class="ml-5 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Change</button> --}}
                  <input wire:model="avatar" type="file"  class="hidden" id="profileImg"/>
                  <label class="mr-2 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm  font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" for="profileImg">عوض کردن</label>
                  
                </div>
                  {{-- @if($avatar)
                    <span class="inline-block h-12 w-12 rounded-full overflow-hidden bg-gray-100">
                      <img src="{{ $avatar->temporaryUrl() }}" alt=""/>
                      
                    </span> 
                    <p>اوکی؟</p>
                    @endif --}}

                    {{-- @if($avatar)
                    <div class=" flex mt-2">
                      <div wire:loading wire:target="photo">بارگذاری...</div>
                  <span class="h-12 w-12 rounded-full overflow-hidden bg-gray-100">
                    <img src="{{ $avatar->temporaryUrl() }}" alt=""/>
                    
                  </span> 
                  <p class="my-auto mr-2">اوکیه؟</p>
                </div>
                @endif --}}

                <div wire:loading wire:target="avatar" >بارگذاری...</div>
                    @if ($avatar)
                    <div class="flex-col text-right">
                        <p class="text-right">اوکیه؟:</p>
                        <button wire:click="deleteProfileImage" type="button" class="px-2 py-2 my-2 text-white my-blue-delete rounded-lg "><i class="fa-solid fa-xmark"></i> حذف عکس</button>
                    </div>
                    <img class="h-12 w-12 rounded-full" src="{{ $avatar->temporaryUrl() }}">
                    {{-- <img class="h-24 w-24 rounded-lg" src="{{ auth()->user()->getAvatar() }}"> --}}
                    @endif
                </div>
              </div>
            <div>
                <input wire:model.defer="name" x-ref="name" type="text" class="w-full border-none text-sm bg-gray-200 rounded-xl placeholder-gray-500
                px-4 py-2 " placeholder="your Idea">
                @error('name')
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
                    <span>اوکیش کن</span>
                </button>
            </div>
        </form>
        <button 
                wire:click="deleteImgPhoto"
                class="flex  bg-red-500 items-center justify-center w-1/2 h-11 text-xs text-white
                font-semibold rounded-xl border-2 border-red-600 hover:border-red-800
                transition duration-150 ease-in">
                    <span>عکس پروفایلمو حذف کن</span>
                </button>
                @error('avatar') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

      </div>
    </div>
  </div>

</div>
