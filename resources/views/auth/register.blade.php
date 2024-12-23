<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- User ID -->
        <div>
            <x-input-label for="userid" :value="__('User ID (NIM/NIP)')" />
            <x-text-input id="userid" class="block mt-1 w-full" type="text" name="userid" :value="old('userid')" required autofocus />
            <x-input-error :messages="$errors->get('userid')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
