<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    use HasFactory;

    protected $fillable = ['titulo', 'descricao', 'caminho', 'crianca_id'];

    // Relação: Foto pertence a uma Criança
    public function crianca()
    {
        return $this->belongsTo(Crianca::class);
    }
}
