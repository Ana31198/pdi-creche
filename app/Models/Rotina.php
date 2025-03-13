<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rotina extends Model
{
    use HasFactory;

    protected $fillable = ['crianca_id', 'data', 'atividade', 'descricao'];

  
    public function crianca()
    {
        return $this->belongsTo(Crianca::class);
    }
     public function scopeDoResponsavel($query, $userName)
{
    return $query->whereRaw('LOWER(nomeresponsavel) = LOWER(?)', [$userName]);
}

}
