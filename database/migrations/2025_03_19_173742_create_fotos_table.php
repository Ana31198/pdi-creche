<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('fotos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('crianca_id')->constrained('criancas')->onDelete('cascade');
            $table->string('titulo');
            $table->text('descricao')->nullable();
            $table->string('caminho'); // Caminho da imagem no storage
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('fotos');
    }
};
