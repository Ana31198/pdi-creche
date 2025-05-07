<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    use HasFactory;

    protected $fillable = ['titulo', 'descricao', 'caminho', 'crianca_id'];


    public function crianca()
    {
        return $this->belongsTo(Crianca::class);
    }
}
