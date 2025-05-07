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

  
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

 
    
    public function isEducador()
    {
        return $this->role === 'educador';
    }

    
    public function isResponsavel()
    {
        return $this->role === 'responsavel';
    }


    public function criancas()
    {
        return $this->hasMany(Crianca::class);
    }


    public function chats()
    {
        return $this->belongsToMany(Chat::class, 'chat_user')->withTimestamps();
    }


    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}