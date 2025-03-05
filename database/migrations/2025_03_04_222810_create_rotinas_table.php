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
        Schema::create('rotinas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('crianca_id')->constrained('criancas')->onDelete('cascade');
            $table->date('data');
            $table->string('atividade');
            $table->text('descricao')->nullable();
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rotinas');
    }
};
