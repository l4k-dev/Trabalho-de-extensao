<x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div>
            <x-input-label for="email" :value="__('Confirme seu E-mail')" />
            <x-text-input id="email" class="block mt-1 w-full border-gray-300 rounded-xl focus:border-blue-500 focus:ring-blue-500"
                type="email"
                name="email"
                :value="old('email', $request->email)"
                required
                autofocus
                autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Nova Senha')" />
            <x-text-input id="password" class="block mt-1 w-full border-gray-300 rounded-xl focus:border-blue-500 focus:ring-blue-500"
                type="password"
                name="password"
                required
                autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmar Nova Senha')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full border-gray-300 rounded-xl focus:border-blue-500 focus:ring-blue-500"
                type="password"
                name="password_confirmation"
                required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-6">
            <x-primary-button class="bg-blue-600 hover:bg-blue-700 rounded-xl">
                {{ __('Redefinir Senha') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>