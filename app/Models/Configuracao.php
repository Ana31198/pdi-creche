<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Configuracao extends Model
{
    //
    protected $table = 'configuracoes';
    protected $fillable = ['hora_abertura', 'hora_fechamento'];
}
