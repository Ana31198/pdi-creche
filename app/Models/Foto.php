<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Crianca;

class Foto extends Model
{
    use HasFactory;

    // Atributos que podem ser preenchidos em massa
    protected $fillable = [
        'titulo',
        'descricao',
        'caminho',
        'crianca_id',
    ];

    /**
     * Relação: Uma foto pertence a uma criança.
     */
public function crianca()
{
    return $this->belongsTo(Crianca::class);
}
}