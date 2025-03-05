<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crianca extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'genero', 'data_nascimento', 'nomeresponsavel', 'graudeparentescodoresponsavel', 'contactoresponsavel', 'image'];

    public function rotinas()
    {
        return $this->hasMany(Rotina::class);
    }
}
