<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Relatório de Gestão - Caxibrema') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="bg-white p-6 rounded-lg shadow border-l-4 border-blue-500">
                    <p class="text-sm text-gray-500 uppercase font-bold">Total de Itens em Estoque</p>
                    <p class="text-3xl font-black text-gray-800">{{ $estoqueTotal }} un</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow border-l-4 border-green-500">
                    <p class="text-sm text-gray-500 uppercase font-bold">Valor Total em Mercadoria</p>
                    <p class="text-3xl font-black text-gray-800">R$ {{ number_format($valorEmEstoque, 2, ',', '.') }}</p>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="font-bold mb-4">Análise por Produto</h3>
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2">Espetinho</th>
                            <th class="py-2">Qtd Atual</th>
                            <th class="py-2">Valor Unitário</th>
                            <th class="py-2 text-right">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($produtos as $produto)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-3">{{ $produto->nome }}</td>
                            <td>{{ $produto->quantidade_estoque }}</td>
                            <td>R$ {{ number_format($produto->preco, 2, ',', '.') }}</td>
                            <td class="text-right font-bold">
                                R$ {{ number_format($produto->quantidade_estoque * $produto->preco, 2, ',', '.') }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>