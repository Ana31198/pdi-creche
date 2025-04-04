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
        Schema::create('configuracoes', function (Blueprint $table) {
            $table->id();
            $table->time('hora_abertura');
            $table->time('hora_fechamento');
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('configuracoes');
    }
    
};
