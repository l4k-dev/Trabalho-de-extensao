<x-app-layout>
    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- 1. CARDS DE RESUMO ESTRATÉGICO --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="bg-white p-6 rounded-[2rem] shadow-xl border-l-[12px] border-blue-500">
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Volume Total em Estoque</p>
                    <p class="text-4xl font-black text-gray-800 italic">{{ $estoqueTotal }} <span class="text-lg not-italic text-gray-400">un</span></p>
                </div>

                <div class="bg-white p-5 rounded-[2rem] shadow-xl border-l-[12px] border-emerald-500">
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Capital Imobilizado (Mercadoria)</p>
                    <p class="text-4xl font-black text-emerald-600 italic">R$ {{ number_format($valorEmEstoque, 2, ',', '.') }}</p>
                </div>
            </div>

            {{-- 2. TABELA DE ANÁLISE TÉCNICA --}}
            <div class="bg-white overflow-hidden shadow-2xl rounded-[2.5rem] border border-gray-100 p-5">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h3 class="text-xl font-black text-gray-800 uppercase italic tracking-tighter">Análise Detalhada de Inventário</h3>
                        <p class="text-xs text-gray-400 font-bold uppercase">Monitoramento de ativos e reposição</p>
                    </div>
                    <span class="bg-blue-50 text-blue-600 text-[10px] font-black px-4 py-2 rounded-full uppercase tracking-widest border border-blue-100">
                        {{ $produtos->total() }} Produtos Cadastrados
                    </span>
                </div>

                <table class="w-full text-left border-separate border-spacing-y-3">
                    <thead>
                        <tr class="text-[10px] font-black text-gray-400 uppercase tracking-widest">
                            <th class="px-6">🍢 Espetinho / Produto</th>
                            <th class="text-center">📦 Qtd Atual</th>
                            <th class="text-center">📊 Status</th>
                            <th class="text-right">💰 Valor Unit.</th>
                            <th class="text-right px-6">🧾 Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($produtos as $produto)
                        @php
                        $subtotal = $produto->quantidade_estoque * $produto->preco;
                        // Lógica visual de status (Exemplo: estoque baixo < 10)
                            $isBaixo=$produto->quantidade_estoque < 10;
                                $isZerado=$produto->quantidade_estoque <= 0;
                                    @endphp
                                    <tr class="bg-gray-50/50 hover:bg-emerald-50 transition-all group">
                                    <td class="py-5 px-6 rounded-l-3xl">
                                        <span class="font-black text-gray-800 uppercase tracking-tighter text-sm">{{ $produto->nome }}</span>
                                    </td>
                                    <td class="text-center font-mono font-bold text-gray-600">
                                        {{ $produto->quantidade_estoque }}
                                    </td>
                                    <td class="text-center">
                                        @if($isZerado)
                                        <span class="bg-red-100 text-red-700 text-[9px] font-black px-3 py-1 rounded-lg uppercase">Esgotado</span>
                                        @elseif($isBaixo)
                                        <span class="bg-amber-100 text-amber-700 text-[9px] font-black px-3 py-1 rounded-lg uppercase">Repor</span>
                                        @else
                                        <span class="bg-emerald-100 text-emerald-700 text-[9px] font-black px-3 py-1 rounded-lg uppercase">OK</span>
                                        @endif
                                    </td>
                                    <td class="text-right text-gray-500 font-medium text-sm">
                                        R$ {{ number_format($produto->preco, 2, ',', '.') }}
                                    </td>
                                    <td class="text-right px-6 rounded-r-3xl font-mono font-black text-gray-800 text-lg">
                                        R$ {{ number_format($subtotal, 2, ',', '.') }}
                                    </td>
                                    </tr>
                                    @endforeach
                    </tbody>
                </table>

                <div class="mt-8 pt-6 border-t border-gray-100">
                    {{ $produtos->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>