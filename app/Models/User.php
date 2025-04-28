<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    // Verifica se o usuário é Admin
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    // Verifica se o usuário é Educador
    public function isEducador()
    {
        return $this->role === 'educador';
    }

    // Verifica se o usuário é Pai (Responsável)
 
    // Verifica se o usuário é Responsável (Pai/Mãe)
    public function isResponsavel()
    {
        return $this->role === 'responsavel'; // Ou ajusta a lógica conforme necessário
    }

    // Relação com Crianças (caso um responsável tenha várias crianças)
    public function criancas()
    {
        return $this->hasMany(Crianca::class);
    }
}
