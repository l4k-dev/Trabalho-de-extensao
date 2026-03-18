<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cadastrar novo Usuario') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4 text-gray-700">🔐 Cadastrar Novo Operador (Funcionário)</h3>
                
                <form method="POST" action="{{ route('usuarios.store') }}" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nome Completo</label>
                        <input type="text" name="name" class="mt-1 w-full rounded border-gray-300 shadow-sm" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">E-mail de Acesso</label>
                        <input type="email" name="email" class="mt-1 w-full rounded border-gray-300 shadow-sm" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Senha Provisória</label>
                        <input type="password" name="password" class="mt-1 w-full rounded border-gray-300 shadow-sm" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Confirmar Senha</label>
                        <input type="password" name="password_confirmation" class="mt-1 w-full rounded border-gray-300 shadow-sm" required>
                    </div>
                    
                    <div class="md:col-span-2 text-right mt-4">
                        <a href="{{ route('dashboard') }}" class="text-gray-600 mr-4 hover:underline">Cancelar</a>
                        <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded font-bold hover:bg-indigo-700 transition">
                            Finalizar Cadastro
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>