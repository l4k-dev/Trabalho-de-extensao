<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 font-medium">
        {{ __('Obrigado por se cadastrar! Antes de começar, você poderia verificar seu endereço de e-mail clicando no link que acabamos de enviar para você? Se você não recebeu o e-mail, teremos o prazer de enviar outro.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
    <div class="mb-4 font-bold text-sm text-green-600 bg-green-50 p-3 rounded-lg border border-green-200">
        {{ __('Um novo link de verificação foi enviado para o endereço de e-mail informado durante o cadastro.') }}
    </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button class="bg-blue-600 hover:bg-blue-700 rounded-xl">
                    {{ __('Reenviar E-mail de Verificação') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 font-bold">
                {{ __('Sair do Sistema') }}
            </button>
        </form>
    </div>
</x-guest-layout>