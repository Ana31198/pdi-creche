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
            $table->string('retirado_por')->nullable()->after('saida'); // Armazena quem retirou a criança
        });
    }
    
    public function down()
    {
        Schema::table('presencas', function (Blueprint $table) {
            $table->dropColumn('retirado_por');
        });
    }
    
};
