<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <x-input-label for="name" :value="__('Nome Completo')" />
            <x-text-input id="name" class="block mt-1 w-full border-gray-300 rounded-xl focus:border-blue-500 focus:ring-blue-500" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Ex: Danilo Borges" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="email" :value="__('E-mail')" />
            <x-text-input id="email" class="block mt-1 w-full border-gray-300 rounded-xl focus:border-blue-500 focus:ring-blue-500" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="exemplo@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Senha')" />
            <x-text-input id="password" class="block mt-1 w-full border-gray-300 rounded-xl focus:border-blue-500 focus:ring-blue-500"
                type="password"
                name="password"
                required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmar Senha')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full border-gray-300 rounded-xl focus:border-blue-500 focus:ring-blue-500"
                type="password"
                name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-6">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" href="{{ route('login') }}">
                {{ __('Já possui cadastro?') }}
            </a>

            <x-primary-button class="ms-4 bg-blue-600 hover:bg-blue-700 rounded-xl">
                {{ __('Cadastrar Operador') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>