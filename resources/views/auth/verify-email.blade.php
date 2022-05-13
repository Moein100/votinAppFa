<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/" class="flex justify-center">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('ممنون از اینکه توی سایت ما ثبت کردین 😄اما قبلش حتما به ایمیلتون سر بزنید و رو اون لینکی یا دکمه ای که براتون ارسال شده کلیک کنین تا اکانتتون فعال بشه تا بتونین از قابلیت های سایت استفاده کنین اگر هم ایمیلی دریافت نکردید مشکلی نیست ما میتونیم دوباره براتون ارسال کینیم') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ __('یه ایمیل جدید دیگه برای فعال سازی اکانتتون به اون ایمیلی که باهاش ثبت نام کردین فرستاده شد ممنون میشیم ایمیلتونو چک کنین') }}
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <x-button class="my-blue">
                        {{ __('ایمیل رو دوباره ارسال کن') }}
                    </x-button>
                </div>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
                    {{ __('خروج از وب سایت') }}
                </button>
            </form>
        </div>
    </x-auth-card>
</x-guest-layout>
