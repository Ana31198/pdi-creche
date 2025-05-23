<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagamento extends Model
{
    use HasFactory;

    protected $fillable = [
        'crianca_id',
        'valor',
        'data_pagamento',
        'descricao',
        'estado',
    ];

    public function crianca()
    {
        return $this->belongsTo(Crianca::class);
    }
}