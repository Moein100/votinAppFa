<div>
    <nav class="hidden lg:flex items-center justify-between text-xs mb-4 text-gray-400">
        <ul class="flex uppercase font-semibold border-b-4 pb-3 space-x-10">
            <li>
                <a wire:click.prevent="setStatus('All')" href="" class="transition duration-150 ease-in hover:border-blue-400 ml-10 border-b-4 pb-3 @if($status == 'All') border-blue-400 text-gray-900 @endif">همه ({{$statusCount['all_statuses']}})</a>
            </li>    
            <li>
                <a wire:click.prevent="setStatus('good')" href="" class=" transition duration-150  ease-in border-b-4 pb-3 hover:border-blue-400 @if($status == 'good') border-blue-400 text-gray-900 @endif">خوب ({{$statusCount['good']}})</a>
            </li>
            <li>
                <a wire:click.prevent="setStatus('great')" href="" class=" transition duration-150 ease-in border-b-4 pb-3 hover:border-blue-400 @if($status == 'great') border-blue-400 text-gray-900 @endif">عالی ({{$statusCount['great']}})</a>
            </li>    
        </ul>   
        
        <ul class="flex uppercase font-semibold border-b-4 pb-3 space-x-10">
            <li>
                <a wire:click.prevent="setStatus('warning')" href="" class="transition duration-150 ease-in ml-10 hover:border-blue-400 border-b-4 pb-3 @if($status == 'warning') border-blue-400 text-gray-900 @endif">اخطار ({{$statusCount['warning']}})</a>
            </li>    
            <li>
                <a wire:click.prevent="setStatus('delete')" href="" class=" transition duration-150 ease-in border-b-4 pb-3 hover:border-blue-400 @if($status == 'delete') border-blue-400 text-gray-900 @endif">حذف ({{$statusCount['delete']}})</a>
            </li>
        </ul> 
    </nav>   
</div>
