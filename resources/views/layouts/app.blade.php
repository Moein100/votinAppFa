<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{$title ?? "Basu Connections"}}</title>

        <!-- Fonts -->
        {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap"> --}}
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">

        <!-- Styles -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" integrity="sha512-wnea99uKIC3TJF7v4eKk4Y+lMz2Mklv18+r4na2Gn1abDRPPOeef95xTzdwGD9e6zXJBteMIhZ1+68QC5byJZw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        @livewireStyles
         <!-- Scripts -->

        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        
        

    </head>
    <body class=" bg-gray-100 text-gray-900 text-sm" dir="rtl">

        <x-ads/>
            <!-- Page Heading -->
            <header class="flex flex-col md:flex-row items-center justify-between px-8 py-4">
                
                    <a href="/"  ><img  class="h-1/3 w-1/3 mx-auto md:mx-0" src="{{asset('img/logo.svg')}}" alt="logo"></a>
                        
                
                <div class="flex items-center mt-2 md:mt-0">
                    @admin
                    <div>
                        <a class="hidden sm:inline-block ml-4 text-sm text-gray-700 dark:text-gray-500 underline" href="/admin/aboute-us"> ویرایش درباره ما</a>
                    </div>
                    <div>
                        <a class="hidden sm:inline-block ml-4 text-sm text-gray-700 dark:text-gray-500 underline" href="/admin/ads">تبلیغات</a>
                    </div>
                    @endadmin
                    
                    <div>
                        <a class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline" href="/aboute-us">درباره ما</a>
                    </div>
                    
                    {{-- <a class="mx-2"href="/aboute-us">
                        درباره ما
                    </a>    --}}
                    @if (Route::has('login'))
                    <div class="  px-6 py-4 ">
                        @auth
                        <div class="flex items-center space-x-4">

                                    <livewire:comment-notifications/>

                        <form  method="POST" action="{{ route('logout') }}">
                            @csrf

                            <a class="mr-3" href="{{route('logout')}}"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{-- {{ __('Log Out') }} --}}
                                 خروج 
                            </a>
                        </form>

                         

                         </div>
                        @else
                            <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline mx-2">ورود</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">ثبت نام</a>
                            @endif
                        @endauth
                    </div>
                    
                @endif
                @auth
                <livewire:top-avatar-and-greeting/>
                  
                    
                @endauth  
                      
                </div>
            </header>


            <div class="container flex justify-center">
                <a href="{{url()->previous()}}"
                class="md:hidden flex items-center font-semibold hover:underline">
                <span class="ml-2">برگرد</span>
                    <svg  class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                </a>
            </div>


            <!-- Page Content -->
            <main class="container mx-auto max-width-all flex flex-col md:flex-row">

                {{-- left sidebar --}}
                <div class="max-width-left  w-full mx-auto md:m-0 md:mr-5">
                    <div class="border-2 md:sticky md:top-8 border-blue-300 rounded-xl mt-16 bg-white">
                        <div class="text-center px-3 py-2 pt-6">
                            <h3 class="font-semibold text-base">
                                نظراتونو به اشتراک بزارین😉
                            </h3>
                            <p class="text-xs mt-4">
                            @auth
                                بهمون بگین چی دوس دارین😄
                            @else
                                برای گذاشتن نظر وارد شوید
                            @endauth
                            </p>
                            
                           <livewire:create-idea />
                            
                           <hr>

                           @auth 
                    <div class="mt-4" >
                        <h2 class="mb-3 font-bold text-xl">ویرایش پروفایل</h2>
                        <hr class="font-bold">
                        <button 
                        x-init
                        @click.prevent="$dispatch('custom-show-edit-profile-modal')"
                        {{-- @click.prevent="console.log('hello')" --}}
                        class="mt-3 flex submit-blue  items-center justify-center w-full h-11 text-xs text-white
                        font-semibold rounded-xl border-2 border-blue-600 hover:border-blue-800 hover:bg-blue-700
                        transition duration-150 ease-in">
                            <span>ویرایش پروفایل</span>
                        </button>
                        <livewire:edit-profile />
                     @endauth
                       </div>
                       
                    </div>

                    </div>
                    
                </div>

                {{-- right side --}}
                <div class="max-width-right w-full px-2 md:px-0">
                    @admin
                    <livewire:status-filters/>
                    @endadmin
                    {{$slot}}
                </div>
            </main>
        </div>


       
        @livewireScripts
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/scripts.js') }}"></script>
        <script src="https://kit.fontawesome.com/7dfad1128c.js" crossorigin="anonymous"></script>
    </body>
</html>
