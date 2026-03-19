<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Venda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdutoController extends Controller
{
    /**
     * Listar produtos no Dashboard principal
     */
    public function index()
    {
        // Ordenamos por nome para facilitar a localização visual
        $produtos = \App\Models\Produto::orderBy('nome', 'asc')->paginate(10);
        return view('dashboard', compact('produtos'));
    }

    /**
     * Cadastrar um novo espetinho no cardápio
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'quantidade_estoque' => 'required|integer|min:0',
            'preco' => 'required|numeric|min:0',
        ]);

        try {
            Produto::create($request->all());
            return redirect()->back()->with('success', 'O item "' . $request->nome . '" foi adicionado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao cadastrar: Verifique se os dados estão corretos.');
        }
    }

    /**
     * Remover um item do cardápio
     */
    public function destroy(Produto $produto)
    {
        $nome = $produto->nome;
        $produto->delete();

        return redirect()->back()->with('success', 'O item "' . $nome . '" foi removido do sistema.');
    }

    /**
     * Lógica de Venda Rápida (-1 unidade)
     */
    public function vender(Produto $produto)
    {
        // Verifica se há estoque disponível
        if ($produto->quantidade_estoque <= 0) {
            return back()->with('error', 'Não foi possível realizar a venda: Estoque de ' . $produto->nome . ' esgotado!');
        }

        // Usamos uma Transaction para garantir que o estoque só mude se a venda for gravada
        DB::transaction(function () use ($produto) {
            // 1. Registra a venda na tabela de histórico
            Venda::create([
                'produto_id' => $produto->id,
                'quantidade' => 1,
                'valor_total' => $produto->preco,
            ]);

            // 2. Diminui o estoque (decrement já salva no banco automaticamente)
            $produto->decrement('quantidade_estoque');
        });

        return back()->with('success', 'Venda de ' . $produto->nome . ' (R$ ' . number_format($produto->preco, 2, ',', '.') . ') realizada!');
    }

    public function relatorio()
    {
        // 1. Calculamos os totais PRIMEIRO sobre todos os registros (antes de paginar)
        $query = Produto::query();

        $estoqueTotal = $query->sum('quantidade_estoque');

        // Para o valor total, usamos uma query bruta ou somamos antes de paginar
        $valorEmEstoque = $query->get()->sum(function ($p) {
            return $p->quantidade_estoque * $p->preco;
        });

        // 2. Agora aplicamos a paginação de 10 para a lista da tabela
        $produtos = Produto::orderBy('nome', 'asc')->paginate(10);

        return view('relatorios.index', compact('estoqueTotal', 'valorEmEstoque', 'produtos'));
    }
    /**
     * Função exclusiva para processar e enviar os dados de vendas para a View
     */
    public function relatorioVendas()
    {
        // 1. Puxa as vendas do banco (Histórico)
        $vendas = \App\Models\Venda::with('produto')->latest()->paginate(10);

        // 2. Calcula os totais que a sua View está pedindo (IMPORTANTE)
        $faturamentoTotal = \App\Models\Venda::sum('valor_total');
        $totalEspetinhos = \App\Models\Venda::sum('quantidade');

        // 3. Manda para a view. Se você não colocar 'faturamentoTotal' aqui, dá o erro que você viu!
        return view('relatorios.vendas', compact('vendas', 'faturamentoTotal', 'totalEspetinhos'));
    }
}
