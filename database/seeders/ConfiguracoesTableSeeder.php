<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Configuracao;

class ConfiguracoesTableSeeder extends Seeder
{
    public function run()
    {
        // Adiciona uma configuração padrão
        Configuracao::create([
            'hora_abertura' => '07:30',
            'hora_fechamento' => '18:00',
        ]);
    }
}
