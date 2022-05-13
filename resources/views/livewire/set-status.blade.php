<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <div
    x-data="{isOpen:false}"
    @click.away="isOpen = false"
    x-init="window.livewire.on('statusWasUpdated', () => { isOpen = false})"
    class='relative'>
       <button
       @click="isOpen = !isOpen"

       @keydown.escape.window="isOpen = false"
       type="button"
       class="flex items-center justify-between md:px-10 px-6 py-2 text-sm bg-gray-200
       font-semibold rounded-xl border border-gray-200 hover:border-gray-400
       transition duration-150 ease-in mt-2 md:mt-0">
           <svg class="h-5 w-5 text-gray-600 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
               <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
           </svg>

           <span> Set Status</span>
       </button>

       <div
       x-show="isOpen" x-transition.origin.top.left.duration.200ms style="display:none"
       class="absolute z-20 w-76 -left-12 text-right font-semibold text-sm bg-white
       shadow-md rounded-xl mt-2">



       <form wire:submit.prevent="setStatus" action="" method="post" class="space-y-4 px-4 py-6">
           <div class="space-y-2">
               <div>
                   <label class="inline-flex items-center">
                       <input wire:model="status" type="radio" checked="" class="text-gray-500 border-none bg-gray-200" name="radio-direct" value="1">
                       <span class="mr-2">باز</span>
                   </label>
               </div>
               <div>
                   <label class="inline-flex items-center">
                       <input wire:model="status" type="radio" checked="" class="text-green-500  border-none bg-gray-200" name="radio-direct" value="2">
                       <span class="mr-2">خوب</span>
                   </label>
               </div>
               <div>
                   <label class="inline-flex items-center">
                       <input wire:model="status" type="radio" checked="" class="text-yellow-500 border-none bg-gray-200" name="radio-direct" value="3">
                       <span class="mr-2">عالی</span>
                   </label>
               </div>
               <div>
                   <label class="inline-flex items-center">
                       <input wire:model="status" type="radio" checked="" class="text-purple-500 border-none bg-gray-200" name="radio-direct" value="4">
                       <span class="mr-2">هشدار</span>
                   </label>
               </div>
               <div>
                   <label class="inline-flex items-center">
                       <input wire:model="status" type="radio" checked="" class="text-red-500 border-none bg-gray-200" name="radio-direct" value="5">
                       <span class="mr-2">حذف</span>
                   </label>
               </div>
           </div>

           <textarea wire:model="comment" name="update_comment" id="" cols="30" rows="3"
           class="w-full text-sm bg-gray-100 rounded-xl placeholder-gray-500 border-none px-4 py-2"
           placeholder="Add a comment "></textarea>

           <div class="flex items-center justify-between space-x-3">
               


               <button type="submit"
               class="flex submit-blue  items-center justify-center w-1/2 h-11 text-xs text-white
               font-semibold rounded-xl border-2 border-blue-600 hover:border-blue-800
               transition duration-150 ease-in disabled:opacity-50">
                   <span>Update</span>
               </button>
           </div>
           {{-- <div>
               <label class="font-normal inline-flex items-center">
                   <input wire:model="notifyAllVoters" type="checkbox" name="notify_voters" class="border-none bg-gray-200" >
                   <span class="mr-2">Notifyl All Voters</span>
               </label>
           </div> --}}
       </form>



       </div>

    </div>
</div>
