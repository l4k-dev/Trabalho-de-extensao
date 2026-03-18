<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sistema Espetinho Caxibrema') }}
        </h2>
    </x-slot>

    <div class="p-6 text-gray-900">
        <form action="{{ route('produtos.store') }}" method="POST" class="mb-8 flex gap-4 items-end">
            @csrf
            <div>
                <label class="block text-sm">Nome do Espetinho</label>
                <input type="text" name="nome" class="rounded border-gray-300 shadow-sm" required>
            </div>
            <div>
                <label class="block text-sm">Estoque Inicial</label>
                <input type="number" name="quantidade_estoque" class="rounded border-gray-300 shadow-sm w-24" required>
            </div>
            <div>
                <label class="block text-sm">Preço (R$)</label>
                <input type="number" step="0.01" name="preco" class="rounded border-gray-300 shadow-sm w-24" required>
            </div>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Adicionar Item</button>
        </form>

        <hr class="mb-6">

        <table class="w-full text-left">
            <thead>
                <tr>
                    <th class="p-2">Produto</th>
                    <th class="p-2">Estoque</th>
                    <th class="p-2">Preço</th>
                    <th class="p-2 text-right">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($produtos as $produto)
                <tr class="border-b">
                    <td class="p-2">{{ $produto->nome }}</td>
                    <td class="p-2 @if($produto->quantidade_estoque < 5) text-red-600 font-bold @endif">
                        {{ $produto->quantidade_estoque }} un
                    </td>
                    <td class="p-2">R$ {{ number_format($produto->preco, 2, ',', '.') }}</td>
                    <td class="p-2 flex justify-end gap-2">
                        <form action="{{ route('produtos.vender', $produto) }}" method="POST">
                            @csrf @method('PATCH')
                            <button class="bg-blue-500 text-white px-2 py-1 rounded text-xs">Venda (-1)</button>
                        </form>

                        <form action="{{ route('produtos.destroy', $produto) }}" method="POST" onsubmit="return confirm('Excluir item?')">
                            @csrf @method('DELETE')
                            <button class="bg-red-500 text-white px-2 py-1 rounded text-xs">Remover</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</x-app-layout>