<?php

namespace App\Models;
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crianca extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome', 'genero', 'data_nascimento', 
        'nomeresponsavel', 'graudeparentescodoresponsavel', 
        'contactodoresponsavel', 'image'
    ];

    // Definir o relacionamento com o modelo Rotina
    public function rotinas()
    {
        return $this->hasMany(Rotina::class, 'crianca_id');
    }
    

    public function scopeDoResponsavel($query, $userName)
    {
        return $query->whereRaw('LOWER(nomeresponsavel) = LOWER(?)',
            [$userName]);   
    }
}
