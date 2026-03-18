<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    use HasFactory;

    // Adicione estas linhas:
    protected $fillable = [
        'produto_id',
        'quantidade',
        'valor_total',
    ];

    // Aproveite para criar a relação com o Produto (ajuda nos relatórios)
    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }
}
