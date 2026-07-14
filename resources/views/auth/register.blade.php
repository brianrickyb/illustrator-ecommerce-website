<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        {{-- Social Media --}}
        <div class="mt-4">
            <x-input-label for="socialMedia" :value="__('Social Media')" />
            <x-text-input id="socialMedia" class="block mt-1 w-full" type="text" name="socialMedia" :value="old('socialMedia')"
                required autocomplete="socialMedia" />
            <x-input-error :messages="$errors->get('socialMedia')" class="mt-2" />
        </div>

        {{-- Address --}}
        <div class="mt-4">
            <x-input-label for="address" :value="__('Address')" />
            <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')"
                required autocomplete="address" />
            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>

        {{-- Country --}}
        <div class="mt-4">
            <x-input-label for="country" :value="__('Country')" />
            <x-text-input id="country" class="block mt-1 w-full" type="text" name="country" :value="old('country')"
                required autocomplete="country" />
            <x-input-error :messages="$errors->get('country')" class="mt-2" />
        </div>

        {{-- Postal Code --}}
        <div class="mt-4">
            <x-input-label for="postalCode" :value="__('Postal Code')" />
            <x-text-input id="postalCode" class="block mt-1 w-full" type="text" name="postalCode" :value="old('postalCode')"
                required autocomplete="postalCode" />
            <x-input-error :messages="$errors->get('postalCode')" class="mt-2" />
        </div>

        {{-- phone number --}}
        <div class="mt-4">
            <x-input-label for="phoneNumber" :value="__('Phone Number')" />
            <x-text-input id="phoneNumber" class="block mt-1 w-full" type="text" name="phoneNumber"
                :value="old('phoneNumber')" required autocomplete="phoneNumber" />
            <x-input-error :messages="$errors->get('phoneNumber')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4 registerbtn">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
