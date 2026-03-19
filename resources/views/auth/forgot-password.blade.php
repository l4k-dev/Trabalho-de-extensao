<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 font-medium">
        {{ __('Esqueceu sua senha? Sem problemas. Basta nos informar seu endereço de e-mail e enviaremos um link de redefinição que permitirá que você escolha uma nova.') }}
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div>
            <x-input-label for="email" :value="__('E-mail Cadastrado')" />
            <x-text-input id="email" class="block mt-1 w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-xl"
                type="email"
                name="email"
                :value="old('email')"
                required
                autofocus
                placeholder="exemplo@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="bg-blue-600 hover:bg-blue-700">
                {{ __('Enviar Link de Redefinição') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>