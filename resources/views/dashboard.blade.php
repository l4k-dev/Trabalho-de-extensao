<x-app-layout>
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-black text-2xl text-gray-800 leading-tight tracking-tight">
                {{ __('🍢 Espetinho Caxibrema') }}
            </h2>
            <div class="text-[10px] font-black bg-gray-100 px-4 py-2 rounded-full text-gray-400 uppercase tracking-widest">
                Painel Administrativo
            </div>
        </div>
    </x-slot>

    <div class="py-12" x-data="{ open: false }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-8 flex justify-end">
                <button @click="open = true"
                    class="group relative inline-flex items-center justify-center px-8 py-4 font-black text-white transition-all duration-200 bg-emerald-600 font-pj rounded-2xl focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-600 shadow-xl shadow-emerald-200 hover:bg-emerald-700 active:scale-95">
                    <svg class="w-5 h-5 mr-2 transition-transform group-hover:rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path>
                    </svg>
                    CADASTRAR NOVO ESPETINHO
                </button>
            </div>

            @if (session('success'))
            <div x-data="{ show: true }"
                x-show="show"
                x-init="setTimeout(() => show = false, 5000)"
                style="background-color: #ecfdf5; border: 2px solid #10b981; color: #064e3b !important;"
                class="mb-6 p-4 rounded-2xl shadow-lg shadow-emerald-100 flex items-center gap-3 animate-bounce">

                <div style="background-color: #10b981;" class="p-1.5 rounded-full text-white">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>

                <span class="font-black uppercase text-xs tracking-wider">
                    {{ session('success') }}
                </span>

                <button @click="show = false" class="ml-auto text-emerald-800/50 hover:text-emerald-800 font-bold">
                    &times;
                </button>
            </div>
            @endif

            <div class="bg-white overflow-hidden shadow-xl shadow-gray-200/50 rounded-[2.5rem] border border-gray-100 p-5 border">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50/50">
                            <tr class="text-[10px] text-gray-400 font-black uppercase tracking-[0.2em] border-b border-gray-100">
                                <th class="px-8 py-5">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-3 h-3 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                        </svg>
                                        <span>Produto</span>
                                    </div>
                                </th>

                                <th class="px-8 py-5 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <svg class="w-3 h-3 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                        </svg>
                                        <span>Estoque</span>
                                    </div>
                                </th>

                                <th class="px-8 py-5 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <svg class="w-3 h-3 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 8c-1.657 0-3 1.343-3 3s1.343 3 3 3 3-1.343 3-3-1.343-3-3-3zM12 2a10 10 0 100 20 10 10 0 000-20z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 6v2m0 8v2M6 12h2m8 0h2"></path>
                                        </svg>
                                        <span>Preço</span>
                                    </div>
                                </th>

                                <th class="px-8 py-5 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                                        </svg>
                                        <span>Ações</span>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($produtos as $produto)
                            @php
                            $estoque = $produto->quantidade_estoque;
                            $isEsgotado = $estoque <= 0;
                                $isBaixo=$estoque < 5 && !$isEsgotado;

                                // Definição de Cores e Ícones
                                $statusConfig=match(true) {
                                $isEsgotado=> ['color' => 'text-red-600 bg-red-50', 'label' => 'Esgotado', 'icon' => '🚫'],
                                $isBaixo => ['color' => 'text-amber-600 bg-amber-50', 'label' => 'Repor', 'icon' => '⚠️'],
                                default => ['color' => 'text-emerald-600 bg-emerald-50', 'label' => 'Ok', 'icon' => '✅'],
                                };
                                @endphp

                                <tr class="group hover:bg-gray-50/80 transition-all border-b border-gray-100 last:border-0">
                                    {{-- Coluna Produto --}}
                                    <td class="px-6 py-5">
                                        <div class="flex items-center gap-3">
                                            <div class="hidden sm:flex w-10 h-10 bg-gray-100 rounded-full items-center justify-center text-lg group-hover:bg-blue-100 transition-colors">
                                                🍢
                                            </div>
                                            <div class="flex flex-col">
                                                <span class="font-bold text-gray-900 uppercase tracking-tight italic">{{ $produto->nome }}</span>
                                                <span class="text-[10px] text-gray-400 font-medium">CÓD: #{{ sprintf('%04d', $produto->id) }}</span>
                                            </div>
                                        </div>
                                    </td>

                                    {{-- Coluna Estoque --}}
                                    <td class="px-6 py-5 text-center">
                                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-lg border border-transparent {{ $statusConfig['color'] }}">
                                            <span class="text-[11px] font-black">{{ $estoque }} UN</span>
                                            <span class="text-[10px] opacity-70 uppercase font-bold tracking-tighter">{{ $statusConfig['label'] }}</span>
                                        </div>
                                    </td>

                                    {{-- Coluna Preço --}}
                                    <td class="px-6 py-5 text-center font-mono font-bold text-gray-600">
                                        <span class="text-xs text-gray-400 mr-0.5">R$ </span>{{ number_format($produto->preco, 2, ',', '.') }}
                                    </td>

                                    {{-- Coluna Ações --}}
                                    <td class="px-6 py-5">
                                        <div class="flex justify-end items-center gap-2">
                                            {{-- Vender --}}
                                            <form action="{{ route('produtos.vender', $produto) }}" method="POST">
                                                @csrf @method('PATCH')
                                                <button
                                                    {{ $isEsgotado ? 'disabled' : '' }}
                                                    class="flex items-center gap-2 px-4 py-2 rounded-xl font-black text-[10px] uppercase tracking-wider transition-all {{ $isEsgotado ? 'bg-gray-100 text-gray-400 cursor-not-allowed' : 'bg-blue-600 text-white hover:bg-blue-700 shadow-md shadow-blue-100 active:scale-95' }}">
                                                    <span>Vender</span>
                                                    <span class="hidden sm:inline">🛒</span>
                                                </button>
                                            </form>

                                            {{-- Deletar --}}
                                            <form action="{{ route('produtos.destroy', $produto) }}" method="POST" onsubmit="return confirm('Excluir {{ $produto->nome }}?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="p-2 hover:bg-red-50 rounded-lg transition-colors">
                                                    <svg class="w-5 h-5" fill="none" stroke="#ef4444" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="px-8 py-6 bg-gray-50/50">
                    {{ $produtos->links() }}
                </div>
            </div>
        </div>

        <div x-show="open"
            class="fixed inset-0 z-[100] flex items-center justify-center p-4"
            x-cloak>

            <div class="fixed inset-0 bg-gray-900/80 backdrop-blur-md transition-opacity"
                x-show="open"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in duration-200"
                @click="open = false"></div>

            <div class="relative bg-white rounded-[3rem] shadow-2xl transform transition-all max-w-lg w-full p-10 z-[110]"
                x-show="open"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-12 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100">

                <div class="flex justify-between items-center mb-8">
                    <h3 class="text-2xl font-black text-gray-800 uppercase italic tracking-tighter"></h3>
                    <button @click="open = false" class="text-red-300 hover:text-gray-500 text-3xl font-light">&times;</button>
                </div>

                <form action="{{ route('produtos.store') }}" method="POST" class="border p-5 space-y-4 max-w-md mx-auto">
                    @csrf

                    <div>
                        <label class="text-[10px] font-black uppercase ml-2 mb-1 block tracking-widest text-blue-600">Nome do Espetinho</label>
                        <input type="text" name="nome"
                            class="w-full rounded-xl border-gray-100 bg-gray-50 focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all py-3 px-4 font-bold text-sm"
                            placeholder="Ex: Cupim Recheado" required>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="text-blue-600 text-[10px] font-black uppercase ml-2 mb-1 block tracking-widest">Estoque Inicial</label>
                            <input type="number" name="quantidade_estoque"
                                class="w-full rounded-xl border-gray-100 bg-gray-50 focus:ring-4 focus:ring-blue-100 py-3 px-4 font-bold text-sm" placeholder="Ex: 1">
                        </div>
                        <div>
                            <label class="text-blue-600 text-[10px] font-black uppercase  ml-2 mb-1 block tracking-widest">Preço Un. (R$)</label>
                            <input type="number" step="0.01" name="preco"
                                class="w-full rounded-xl border-gray-100 bg-gray-50 focus:ring-4 focus:ring-blue-100 py-3 px-4 font-bold text-sm font-mono" placeholder="Ex: 10,00">
                        </div>
                    </div>

                    <div class="pt-6 flex flex-row items-center justify-start gap-3" style="width: 100%;">

                        <button type="submit"
                            style="width: 160px !important; margin: 0;"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-black py-3 rounded-xl shadow-lg shadow-blue-200 transition-all active:scale-95 uppercase tracking-widest text-[10px] border-none outline-none cursor-pointer">
                            Confirmar 🍢
                        </button>

                        <button type="button" @click="open = false"
                            style="width: 100px !important; margin: 0;"
                            class="bg-red-500 hover:bg-red-600 text-white font-black py-3 rounded-xl shadow-md transition-all active:scale-95 uppercase text-[9px] tracking-widest border-none outline-none cursor-pointer">
                            Cancelar
                        </button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>