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
        Schema::table('presencas', function (Blueprint $table) {
            $table->time('saida')->nullable()->after('hora'); // Adiciona a coluna de saída
        });
    }
    
    public function down()
    {
        Schema::table('presencas', function (Blueprint $table) {
            $table->dropColumn('saida');
        });
    }
    
};
