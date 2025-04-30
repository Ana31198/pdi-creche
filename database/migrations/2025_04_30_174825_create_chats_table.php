<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatsTable extends Migration
{
    public function up()
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('educador_id')->constrained('users');  // Educador (relacionado com a tabela de utilizadores)
            $table->foreignId('responsavel_id')->constrained('users'); // Responsável (relacionado com a tabela de utilizadores)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('chats');
    }
}
