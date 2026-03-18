<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    // Listar produtos (Read)
    public function index()
    {
        $produtos = \App\Models\Produto::all();
        return view('dashboard', compact('produtos')); // Agora o dashboard recebe os produtos
    }

    public function store(Request $request)
    {
        $request->validate(['nome' => 'required', 'quantidade_estoque' => 'required|integer', 'preco' => 'required|numeric']);
        \App\Models\Produto::create($request->all());
        return redirect()->back()->with('success', 'Cadastrado!');
    }

    public function destroy(\App\Models\Produto $produto)
    {
        $produto->delete();
        return redirect()->back();
    }

    public function vender(\App\Models\Produto $produto)
    {
        if ($produto->quantidade_estoque > 0) {
            $produto->decrement('quantidade_estoque');
        }
        return redirect()->back();
    }
}
