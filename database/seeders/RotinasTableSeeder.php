<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rotina;
use App\Models\Crianca;
use Carbon\Carbon;

class RotinasTableSeeder extends Seeder
{
    public function run()
    {
        // Obtém a primeira criança (ou você pode personalizar a lógica de seleção)
        $crianca = Crianca::first();

        if (!$crianca) {
            echo "Nenhuma criança encontrada. Corre o CriancasTableSeeder primeiro.\n";
            return;
        }

        // Adiciona algumas rotinas para essa criança
        Rotina::create([
            'crianca_id' => $crianca->id,
            'data' => Carbon::now()->format('Y-m-d'),
            'atividade' => 'Brincadeira no parque',
            'descricao' => 'A criança participou de atividades ao ar livre no parque da creche.',
        ]);

        Rotina::create([
            'crianca_id' => $crianca->id,
            'data' => Carbon::now()->format('Y-m-d'),
            'atividade' => 'Almoço',
            'descricao' => 'A criança almoçou no horário regular às 12h.',
        ]);

        Rotina::create([
            'crianca_id' => $crianca->id,
            'data' => Carbon::now()->format('Y-m-d'),
            'atividade' => 'Soneca',
            'descricao' => 'A criança tirou uma soneca de 14h às 15h.',
        ]);
    }
}
