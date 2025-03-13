<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fotografia extends Model
{
    use HasFactory;

    protected $fillable = ['crianca_id', 'caminho'];

    public function crianca()
    {
        return $this->belongsTo(Crianca::class);
    }
}