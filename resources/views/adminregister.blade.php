<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <img src="{{ URL::to('img/logo-no-background.png') }}" class="navbar-brand-img h-50" alt="main_logo">
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('admregister') }}">
            @csrf

            <!-- FirstName -->
            <div>
                <x-label for="FirstName" :value="__('First Name')" />
                <x-input id="FirstName" class="block mt-1 w-full" type="text" name="FirstName" :value="old('FirstName')" required autofocus />
            </div>

            <!-- Lastname -->
            <div>
                <x-label for="Lastname" :value="__('Last name')" />
                <x-input id="Lastname" class="block mt-1 w-full" type="text" name="Lastname" :value="old('Lastname')" required autofocus />
            </div>

            <!-- National ID -->
            <div>
                <x-label for="National_id" :value="__('National id')" />
                <x-input id="National_id" class="block mt-1 w-full" type="integer" name="National_id" :value="old('National_id')" required autofocus />
            </div>

            <!-- Username -->
            <div>
                <x-label for="Username" :value="__('Username')" />
                <x-input id="Username" class="block mt-1 w-full" type="text" name="Username" :value="old('Username')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ URL::to('voter/login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>