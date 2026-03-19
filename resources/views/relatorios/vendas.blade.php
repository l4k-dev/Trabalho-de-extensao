<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="bg-white p-6 rounded-[2rem] shadow-xl border-l-[12px] border-emerald-500">
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Faturamento Total</p>
                    <p class="text-4xl font-black text-gray-800 italic">R$ {{ number_format($faturamentoTotal, 2, ',', '.') }}</p>
                </div>

                <div class="bg-white p-6 rounded-[2rem] shadow-xl border-l-[12px] border-blue-500">
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Espetinhos Vendidos</p>
                    <p class="text-4xl font-black text-gray-800 italic">{{ $totalEspetinhos }} <span class="text-lg not-italic text-gray-400 text-sm">un</span></p>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-2xl rounded-[2.5rem] border border-gray-100 p-5">
                <table class="w-full text-left border-separate border-spacing-y-3">
                    <thead>
                        <tr class="text-[10px] font-black text-gray-400 uppercase tracking-widest">
                            <th class="px-4">🕒 Data/Hora</th>
                            <th>🍢 Produto</th>
                            <th class="text-center">🔢 Qtd</th>
                            <th class="text-right px-4">💰 Valor Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($vendas as $venda)
                        <tr class="bg-gray-50/50 hover:bg-blue-50 transition-all group">
                            <td class="py-5 px-4 rounded-l-2xl text-xs font-bold text-gray-500">
                                {{ $venda->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="font-black text-gray-800 uppercase tracking-tighter">
                                {{ $venda->produto->nome ?? 'Item Removido' }}
                            </td>
                            <td class="text-center">
                                <span class="bg-white px-3 py-1 rounded-lg border border-gray-200 font-black text-sm">
                                    {{ $venda->quantidade }}
                                </span>
                            </td>
                            <td class="text-right px-4 rounded-r-2xl font-mono font-black text-emerald-600 text-lg">
                                R$ {{ number_format($venda->valor_total, 2, ',', '.') }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-8 pt-6 border-t border-gray-100">
                    {{ $vendas->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>