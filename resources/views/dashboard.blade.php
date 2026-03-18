<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestão de Estoque - Espetinho Caxibrema') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" class="mb-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 shadow-sm">
                {{ session('success') }}
            </div>
            @endif

            @if (session('error'))
            <div class="mb-4 p-4 bg-red-100 border-l-4 border-red-500 text-red-700 shadow-sm">
                {{ session('error') }}
            </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <div class="mb-10 bg-gray-50 p-6 rounded-xl border border-gray-100">
                    <h3 class="text-lg font-bold mb-4 text-gray-700">Cadastrar Novo Espetinho</h3>
                    <form action="{{ route('produtos.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                        @csrf
                        <div class="md:col-span-1">
                            <x-input-label for="nome" :value="__('Nome do Espetinho')" />
                            <x-text-input id="nome" name="nome" type="text" class="mt-1 block w-full" placeholder="Ex: Carne com Queijo" required />
                        </div>
                        <div>
                            <x-input-label for="quantidade_estoque" :value="__('Estoque Inicial')" />
                            <x-text-input id="quantidade_estoque" name="quantidade_estoque" type="number" class="mt-1 block w-full" required />
                        </div>
                        <div>
                            <x-input-label for="preco" :value="__('Preço Unitário (R$)')" />
                            <x-text-input id="preco" name="preco" type="number" step="0.01" class="mt-1 block w-full" required />
                        </div>
                        <x-primary-button class="justify-center h-11 bg-green-700 hover:bg-green-800">
                            {{ __('Adicionar ao Cardápio') }}
                        </x-primary-button>
                    </form>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                            <tr>
                                <th scope="col" class="px-6 py-4">Produto</th>
                                <th scope="col" class="px-6 py-4">Estoque</th>
                                <th scope="col" class="px-6 py-4">Preço</th>
                                <th scope="col" class="px-6 py-4 text-right">Ações de Venda e Gestão</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($produtos as $produto)
                            <tr class="bg-white border-b hover:bg-gray-50 transition">
                                <td class="px-6 py-4 font-bold text-gray-900">{{ $produto->nome }}</td>
                                <td class="px-6 py-4">
                                    @if($produto->quantidade_estoque < 5)
                                        <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full border border-red-400">
                                        Crítico: {{ $produto->quantidade_estoque }} un
                                        </span>
                                        @else
                                        <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                            {{ $produto->quantidade_estoque }} un
                                        </span>
                                        @endif
                                </td>
                                <td class="px-6 py-4 text-gray-700 font-medium">
                                    R$ {{ number_format($produto->preco, 2, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 flex justify-end gap-3">
                                    <form action="{{ route('produtos.vender', $produto) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <button class="inline-flex items-center px-3 py-1 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                            🛒 Vender (-1)
                                        </button>
                                    </form>

                                    <form action="{{ route('produtos.destroy', $produto) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja remover este item do cardápio?')">
                                        @csrf @method('DELETE')
                                        <button class="text-red-600 hover:text-red-900 font-bold px-2 py-1">
                                            Remover
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-6 py-4 border-t border-gray-100">
                    {{ $produtos->links() }}
                    <p class="text-xs text-gray-400 mt-2">
                        Mostrando {{ $produtos->firstItem() }} até {{ $produtos->lastItem() }} de um total de {{ $produtos->total() }} espetinhos.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>