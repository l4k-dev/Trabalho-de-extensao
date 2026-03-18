<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Relatório de Vendas - Espetinho Caxibrema') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-lg shadow border-l-4 border-green-500">
                    <p class="text-sm text-gray-500 font-bold uppercase">Faturamento Total</p>
                    <p class="text-3xl font-black">R$ {{ number_format($vendas->sum('valor_total'), 2, ',', '.') }}</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow border-l-4 border-blue-500">
                    <p class="text-sm text-gray-500 font-bold uppercase">Total de Espetinhos Vendidos</p>
                    <p class="text-3xl font-black">{{ $vendas->sum('quantidade') }} un</p>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b text-gray-400">
                            <th class="py-3">Data/Hora</th>
                            <th>Produto</th>
                            <th>Qtd</th>
                            <th class="text-right">Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($vendas as $venda)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-3 text-sm">{{ $venda->created_at->format('d/m/Y H:i') }}</td>
                            <td class="font-semibold">{{ $venda->produto->nome }}</td>
                            <td>{{ $venda->quantidade }}</td>
                            <td class="text-right">R$ {{ number_format($venda->valor_total, 2, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>