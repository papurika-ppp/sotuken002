<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="user_name" :value="__('User_name')" />
            <x-text-input id="user_name" class="block mt-1 w-full" type="text" name="user_name" :value="old('user_name')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('user_name')" class="mt-2" />
        </div>

        <!-- User ID -->
        <div class="mt-4">
            <x-input-label for="user_id" :value="__('User_id')" />
            <x-text-input id="user_id" class="block mt-1 w-full" type="text" name="user_id" :value="old('user_id')" required autocomplete="userid" />
            <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- is Enable Google2fa 

        <div class="block mt-4">

            <label for="is_enable_google2fa" class="inline-flex items-center">

                <input id="is_enable_google2fa" type="checkbox"

                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="is_enable_google2fa" value="1" checked="checked">

                <span class="ml-2 text-sm text-gray-600">{{ __('Enable Google 2fa') }}</span>

            </label>

        </div>-->
        <input type="hidden" id="is_enable_google2fa" name="is_enable_google2fa" value="1">



        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
