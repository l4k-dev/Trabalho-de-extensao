<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 font-medium">
        {{ __('Esta é uma área segura do sistema. Por favor, confirme sua senha antes de continuar para o painel do Caxibrema.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div>
            <x-input-label for="password" :value="__('Senha de Acesso')" />

            <x-text-input id="password" class="block mt-1 w-full border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 rounded-xl"
                type="password"
                name="password"
                required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex justify-end mt-4">
            <x-primary-button class="bg-emerald-600 hover:bg-emerald-700">
                {{ __('Confirmar Senha') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>