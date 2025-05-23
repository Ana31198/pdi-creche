<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
 public function up()
{
    Schema::create('pagamentos', function (Blueprint $table) {
        $table->id();
        $table->foreignId('crianca_id')->constrained()->onDelete('cascade'); // relação com crianças
        $table->decimal('valor', 8, 2);
        $table->date('data_pagamento');
        $table->string('descricao')->nullable();
        $table->enum('estado', ['pago', 'pendente'])->default('pendente');
        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('pagamentos');
    }
};
