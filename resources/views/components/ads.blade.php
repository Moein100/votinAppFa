<div>
    <!-- The only way to do great work is to love what you do. - Steve Jobs -->
    @if($imageAds)
    {{-- @dd(strpos($image,'ds/')) --}}
    @if(strpos($imageAds,'adsimage'))
    <a href="{{$urlAds}}" class="block w-full z-10" target="_blank">
        <div style="height: 60px;"><img class="w-100" src="{{asset('/app/'.$imageAds)}}" height="60" style="object-fit: cover;">
        
        </div>
    </a>
    @else
    
    <a href="{{$urlAds}}" class="block w-full z-10" target="_blank">
        <div style="height: 60px;"><img class="w-100" src="{{$imageAds}}" height="60" style="object-fit: cover;">
        
        </div>
    </a>
    @endif    
    @endif


    
</div>