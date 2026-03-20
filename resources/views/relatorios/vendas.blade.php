<x-app-layout>
    <div class="py-12 bg-gray-50"> {{-- Adicionei um fundo leve para destacar os cards --}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">{{-- SEÇÃO HORÁRIOS DE PICO --}}
            {{-- 1. CAMADA DE INDICADORES (KPIs) - Compactada com p-5 e hover sutil --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">
                {{-- Card Faturamento --}}
                <div class="bg-white p-5 rounded-[2rem] shadow-lg border-l-[10px] border-emerald-500 hover:scale-[1.02] transition-transform">
                    <div class="flex justify-between items-center mb-3 border-b border-gray-50 pb-2">
                        <p class="text-[10px] font-black text-emerald-600 uppercase tracking-[0.2em] italic">Faturamento Total</p>
                        <span class="text-xl">💰</span>
                    </div>
                    <div class="flex items-end justify-between">
                        <p class="text-3xl font-black text-gray-800 italic tracking-tighter">
                            <span class="text-xs not-italic text-gray-300 mr-1">R$</span>{{ number_format($faturamentoTotal, 2, ',', '.') }}
                        </p>
                        <span class="text-[9px] text-gray-300 uppercase font-medium">Tempo Real</span>
                    </div>
                </div>

                {{-- Card Ticket Médio --}}
                <div class="bg-white p-5 rounded-[2rem] shadow-lg border-l-[10px] border-amber-500 hover:scale-[1.02] transition-transform">
                    <div class="flex justify-between items-center mb-3 border-b border-gray-50 pb-2">
                        <p class="text-[10px] font-black text-amber-600 uppercase tracking-[0.2em] italic">Ticket Médio</p>
                        <span class="text-xl">🎟️</span>
                    </div>
                    <div class="flex items-end justify-between">
                        <p class="text-3xl font-black text-gray-800 italic tracking-tighter">
                            <span class="text-xs not-italic text-gray-300 mr-1">R$</span>{{ number_format($ticketMedio, 2, ',', '.') }}
                        </p>
                        <span class="text-[9px] text-gray-300 uppercase font-medium">Por Venda</span>
                    </div>
                </div>

                {{-- Card Volume --}}
                <div class="bg-white p-5 rounded-[2rem] shadow-lg border-l-[10px] border-blue-500 hover:scale-[1.02] transition-transform">
                    <div class="flex justify-between items-center mb-3 border-b border-gray-50 pb-2">
                        <p class="text-[10px] font-black text-blue-600 uppercase tracking-[0.2em] italic">Itens Vendidos</p>
                        <span class="text-xl">🍢</span>
                    </div>
                    <div class="flex items-end justify-between">
                        <p class="text-3xl font-black text-gray-800 italic tracking-tighter">
                            {{ $totalEspetinhos }} <span class="text-base not-italic text-gray-300 uppercase">un</span>
                        </p>
                        <span class="text-[9px] text-gray-300 uppercase font-medium">Volume</span>
                    </div>
                </div>
            </div>

            {{-- 2. SEÇÃO GRÁFICO DE FLUXO - Compactada com p-5 e h-40 --}}
            <div class="bg-white p-5 rounded-[2.5rem] shadow-2xl border border-gray-100 relative overflow-hidden">
                {{-- Decoração sutil de fundo --}}
                <div class="absolute top-0 right-0 -mt-8 -mr-8 w-32 h-32 bg-blue-50 rounded-full opacity-40"></div>

                <div class="relative z-10 flex items-center justify-between mb-8 gap-4 border-b border-gray-50 pb-4">
                    <div>
                        <h2 class="text-lg font-black text-gray-800 uppercase italic tracking-tighter flex items-center">
                            <span class="mr-3">🔥</span> Fluxo de Horário
                        </h2>
                        <p class="text-[9px] text-gray-400 font-bold uppercase tracking-widest mt-1">Volume de pedidos por faixa horária</p>
                    </div>

                    {{-- Insight Compacto --}}
                    <div class="bg-blue-600 px-5 py-2 rounded-xl shadow-lg shadow-blue-100 flex items-center gap-3">
                        <span class="text-lg">📈</span>
                        <div>
                            <p class="text-[8px] font-black text-blue-100 uppercase italic leading-none">Pico</p>
                            <p class="text-white font-black text-sm italic">{{ $vendasPorHora->sortByDesc('total_pedidos')->first()->hora ?? '0' }}h</p>
                        </div>
                    </div>
                </div>

                {{-- Área do Gráfico (Altura Reduzida) --}}
                <div class="flex items-end h-40 gap-1 px-1 border-b-2 border-gray-50 pb-1">
                    @php $maxPedidos = $vendasPorHora->max('total_pedidos') ?: 1; @endphp

                    @foreach($vendasPorHora as $fluxo)
                    @php $altura = ($fluxo->total_pedidos / $maxPedidos) * 100; @endphp
                    <div class="flex-1 flex flex-col items-center group h-full justify-end">
                        {{-- Tooltip Minimalista --}}
                        <div class="mb-1 opacity-0 group-hover:opacity-100 transition-all transform translate-y-2 group-hover:translate-y-0 relative z-20">
                            <span class="bg-gray-800 text-white text-[8px] font-black px-1.5 py-0.5 rounded shadow-xl">
                                {{ $fluxo->total_pedidos }}
                            </span>
                        </div>

                        {{-- Barra do Gráfico --}}
                        <div class="w-full relative rounded-t-lg transition-all duration-500 hover:bg-blue-500 {{ $altura == 100 ? 'bg-blue-600' : 'bg-blue-100' }}"
                            style="height: {{ $altura }}%">
                            @if($altura == 100)
                            <div class="absolute inset-0 bg-blue-400 animate-ping rounded-t-lg opacity-20"></div>
                            @endif
                        </div>

                        {{-- Legenda da Hora --}}
                        <span class="text-[8px] font-bold text-gray-500 mt-2 uppercase italic">
                            {{ str_pad($fluxo->hora, 2, '0', STR_PAD_LEFT) }}h
                        </span>
                    </div>
                    @endforeach
                </div>

                {{-- Rodapé Operacional Compacto --}}
                <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-gray-50 p-4 rounded-xl border border-gray-100 flex justify-between items-center">
                        <div class="flex items-center gap-3">
                            <span class="text-sm">💡</span>
                            <p class="text-xs text-gray-600 leading-tight">
                                Reforço na brasa sugerido para às
                                <strong class="text-blue-600 font-black italic">{{ ($vendasPorHora->sortByDesc('total_pedidos')->first()->hora ?? 18) - 1 }}h:30</strong>.
                            </p>
                        </div>
                        <span class="bg-white px-3 py-1 text-[9px] font-black text-blue-500 rounded-full shadow-inner border border-blue-50 uppercase italic">Sugestão</span>
                    </div>
                </div>
            </div>

            {{-- 2. SEÇÃO RANKING ABC (Ocupando largura total para melhor leitura das barras) --}}
            <div class="mb-8 bg-white p-8 rounded-[2.5rem] shadow-2xl border border-amber-100 p-5">
                <div class="flex items-center mb-8">
                    <span class="text-3xl mr-3">🏆</span>
                    <div>
                        <h2 class="text-xl font-black text-gray-800 uppercase italic tracking-tighter">Ranking de Faturamento (Top 10)</h2>
                        <p class="text-xs text-gray-400 font-bold uppercase">Análise de performance por produto</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-6">
                    @foreach($topProdutos as $item)
                    @php
                    $percentual = $faturamentoTotal > 0 ? ($item->faturamento_por_produto / $faturamentoTotal) * 100 : 0;
                    @endphp
                    <div class="bg-gray-50 p-4 rounded-2xl border border-gray-100">
                        <div class="flex justify-between mb-2 text-xs font-black uppercase italic text-gray-700">
                            <span>{{ $item->produto->nome ?? 'Item Removido' }}</span>
                            <span class="text-emerald-600">R$ {{ number_format($item->faturamento_por_produto, 2, ',', '.') }}</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-4 overflow-hidden shadow-inner">
                            <div class="bg-gradient-to-r from-emerald-400 to-emerald-600 h-4 rounded-full transition-all duration-500"
                                style="width: {{ $percentual }}%"></div>
                        </div>
                        <div class="flex justify-between mt-2">
                            <p class="text-[9px] text-gray-400 uppercase font-bold">{{ number_format($item->qtd_vendida) }} unidades vendidas</p>
                            <p class="text-[9px] font-black text-gray-500 uppercase tracking-widest">{{ number_format($percentual, 1) }}% do total</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- 3. TABELA DE HISTÓRICO --}}
            <div class="bg-white overflow-hidden shadow-2xl rounded-[2.5rem] border border-gray-100 p-6">
                <h3 class="text-sm font-black text-gray-400 uppercase tracking-[0.2em] mb-6 px-4">🕒 Histórico de Vendas Recentes</h3>
                <table class="w-full text-left border-separate border-spacing-y-3">
                    <thead>
                        <tr class="text-[10px] font-black text-gray-400 uppercase tracking-widest">
                            <th class="px-6">Data/Hora</th>
                            <th>Produto</th>
                            <th class="text-center">Qtd</th>
                            <th class="text-right px-6">Valor Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($vendas as $venda)
                        <tr class="bg-gray-50/50 hover:bg-blue-50 transition-all group">
                            <td class="py-5 px-6 rounded-l-3xl text-xs font-bold text-gray-500">
                                {{ $venda->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="font-black text-gray-800 uppercase tracking-tighter text-sm">
                                {{ $venda->produto->nome ?? 'Item Removido' }}
                            </td>
                            <td class="text-center">
                                <span class="bg-white px-4 py-1.5 rounded-xl border border-gray-200 font-black text-sm shadow-sm">
                                    {{ $venda->quantidade }}
                                </span>
                            </td>
                            <td class="text-right px-6 rounded-r-3xl font-mono font-black text-emerald-600 text-lg">
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