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
        {{-- @livewireStyles --}}
         <!-- Scripts -->

        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        
        

    </head>
    <body class=" bg-gray-100 text-gray-900 text-sm" dir="rtl">

            <!-- Page Heading -->
            <header class="flex flex-col md:flex-row items-center justify-between px-8 py-4">
                
                    <a href="/"  ><img  class="h-1/3 w-1/3 mx-auto md:mx-0" src="{{asset('img/logo.svg')}}" alt="logo"></a>
                        
                
                <div class="flex items-center mt-2 md:mt-0">
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
            <main class="container mx-auto max-width-all flex flex-col md:flex-row">
                {{-- <div>
                    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی مورد نیاز، و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد، کتابهای زیادی در شصت و سه درصد گذشته حال و آینده، شناخت فراوان جامعه و متخصصان را می طلبد، تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی، و فرهنگ پیشرو در زبان فارسی ایجاد کرد، در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها، و شرایط سخت تایپ به پایان رسد و زمان مورد نیاز شامل حروفچینی دستاوردهای اصلی، و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.
                </div> --}}
                @if($body)
                <div>
                    {!!$body!!}
                </div>
                @else
                <div>
                    به زودی این قسمتو پر میکنیم براتون😉
                </div>
                @endif
                @if ($links)
                <div>
                    
                    {!!$links!!}
                </div>
                @endif
            </main>




            {{-- @livewireScripts --}}
            <script src="{{ asset('js/app.js') }}"></script>
            <script src="{{ asset('js/scripts.js') }}"></script>
            <script src="https://kit.fontawesome.com/7dfad1128c.js" crossorigin="anonymous"></script>
        </body>
    </html>
    