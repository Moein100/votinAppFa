<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/" class="flex justify-center">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('ایمیلی که باهاش حساب کاربریتونو ایجاد کردینو وارد کنین تا براتون لینک بازیابی رمز عبور فرستاده بشه') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center justify-start mt-4">
                <x-button class="my-blue">
                    {{ __('لینکو برام ایمیل کن') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
