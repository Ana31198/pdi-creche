<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


    use Illuminate\Database\Eloquent\Factories\HasFactory;

    
    class Presenca extends Model
    {
        use HasFactory;
    
        protected $fillable = [
            'crianca_id', 
            'data', 
            'hora', 
            'tipo', 
            'responsavel'
        ];
        
        public function crianca()
        {
            return $this->belongsTo(Crianca::class);
        }
         public function scopeDoResponsavel($query, $userName)
    {
        return $query->whereRaw('LOWER(nomeresponsavel) = LOWER(?)', [$userName]);
    }
    
    }