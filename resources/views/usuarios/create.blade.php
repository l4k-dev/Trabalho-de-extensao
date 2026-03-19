<x-app-layout>
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-black text-2xl text-gray-800 leading-tight tracking-tight uppercase italic">
                {{ __('👥 Gestão de Equipe') }}
            </h2>
            <div class="text-[10px] font-black bg-blue-50 px-4 py-2 rounded-full text-blue-600 uppercase tracking-widest">
                Novo Operador
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-xl shadow-gray-200/50 rounded-[2.5rem] border border-gray-100 p-5 border">

                <div class="mb-10">
                    <h3 class="text-2xl font-black text-gray-800 italic tracking-tighter uppercase">
                        🔐 Cadastrar Operador
                    </h3>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-1">
                        Defina o acesso para o novo funcionário
                    </p>
                </div>

                <form method="POST" action="{{ route('usuarios.store') }}" class="space-y-6">
                    @csrf

                    <div class="group">
                        <label class="text-[10px] font-black uppercase text-gray-400 ml-2 mb-1.5 flex items-center gap-1 tracking-widest">
                            <span class="w-1.5 h-3 bg-blue-600 rounded-full"></span> Nome Completo
                        </label>
                        <input type="text" name="name"
                            class="w-full rounded-2xl border-2 border-gray-50 bg-gray-50/50 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100 transition-all py-3.5 px-6 font-bold text-sm placeholder-gray-300"
                            placeholder="Ex: João da Silva" required>
                    </div>

                    <div class="group">
                        <label class="text-[10px] font-black uppercase text-gray-400 ml-2 mb-1.5 block tracking-widest">E-mail de Acesso</label>
                        <input type="email" name="email"
                            class="w-full rounded-2xl border-2 border-gray-50 bg-gray-50/50 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100 transition-all py-3.5 px-6 font-bold text-sm"
                            placeholder="joao@espetinho.com" required>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="text-[10px] font-black uppercase text-gray-400 ml-2 mb-1.5 block tracking-widest text-blue-600">Senha Provisória</label>
                            <input type="password" name="password"
                                class="w-full rounded-2xl border-2 border-gray-50 bg-gray-50/50 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100 py-3.5 px-6 font-bold text-sm" required>
                        </div>
                        <div>
                            <label class="text-[10px] font-black uppercase text-gray-400 ml-2 mb-1.5 block tracking-widest">Confirmar Senha</label>
                            <input type="password" name="password_confirmation"
                                class="w-full rounded-2xl border-2 border-gray-50 bg-gray-50/50 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100 py-3.5 px-6 font-bold text-sm" required>
                        </div>
                    </div>

                    <div class="pt-10 flex items-center justify-start gap-4" style="width: 100%;">

                        <button type="submit"
                            style="width: 220px !important;"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-black py-4 rounded-2xl shadow-xl shadow-blue-100 transition-all active:scale-95 uppercase tracking-widest text-[11px] border-none">
                            Finalizar Cadastro
                        </button>

                        <a href="{{ route('dashboard') }}"
                            style="width: 120px !important;"
                            class="bg-red-500 hover:bg-red-600 text-white font-black py-4 rounded-2xl shadow-md transition-all active:scale-95 uppercase text-[9px] tracking-widest text-center">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>