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
                $table->time('hora_abertura')->default('07:30');
                $table->time('hora_fechamento')->default('18:00');
                $table->timestamps();
            });
        }
        
    
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('configuracoes');
    }
};
