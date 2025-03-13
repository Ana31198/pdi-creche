<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('presencas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('crianca_id')->constrained()->onDelete('cascade');
            $table->date('data');
            $table->time('hora_entrada')->nullable(); // Hora de entrada
            $table->time('hora_saida')->nullable();   // Hora de saída
            $table->string('responsavel')->nullable();  // Nome do responsável
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presencas');
    }
};
