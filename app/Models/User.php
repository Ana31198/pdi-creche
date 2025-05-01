<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Crianca;
use App\Models\Chat;
use App\Models\Message;

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

    // Verifica se o usuário é Responsável
    public function isResponsavel()
    {
        return $this->role === 'responsavel';
    }

    // Relação com crianças (ex: responsáveis)
    public function criancas()
    {
        return $this->hasMany(Crianca::class);
    }

    // Relação com chats (pivot chat_user)
    public function chats()
    {
        return $this->belongsToMany(Chat::class, 'chat_user')->withTimestamps();
    }

    // Relação com mensagens
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}