<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('presencas', function (Blueprint $table) {
            $table->dropColumn(['hora_entrada', 'hora_saida']);
            $table->time('hora')->nullable(); // Hora do registo (entrada ou saída)
            $table->enum('tipo', ['entrada', 'saida'])->default('entrada'); // Tipo de registo
        });
    }
    
    public function down()
    {
        Schema::table('presencas', function (Blueprint $table) {
            $table->dropColumn(['hora', 'tipo']);
            $table->time('hora_entrada')->nullable();
            $table->time('hora_saida')->nullable();
        });
    }
   
};
