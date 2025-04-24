<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Presenca;
use App\Models\Crianca;
use Carbon\Carbon;

class PresencasTableSeeder extends Seeder
{
    public function run()
    {
        // Obtém a primeira criança (pode mudar conforme a lógica desejada)
        $crianca = Crianca::first(); 

        if (!$crianca) {
            echo "Nenhuma criança encontrada. Corre o CriancasTableSeeder primeiro.\n";
            return;
        }

        // Simula entradas e saídas
        Presenca::create([
            'crianca_id' => $crianca->id,
            'data' => Carbon::now()->format('Y-m-d'),
            'hora' => '08:00',
            'responsavel' => 'Maria Oliveira',  // exemplo de responsável
        ]);

        Presenca::create([
            'crianca_id' => $crianca->id,
            'data' => Carbon::now()->format('Y-m-d'),
            'hora' => '08:30',
            'responsavel' => 'Carlos Silva',  // exemplo de responsável
        ]);

        // Exemplo de presença com saída
        $presenca = Presenca::create([
            'crianca_id' => $crianca->id,
            'data' => Carbon::now()->format('Y-m-d'),
            'hora' => '07:45',
            'responsavel' => 'Maria Oliveira',
        ]);

        $presenca->saida = '16:30';  // Adiciona a hora de saída
        $presenca->save();
    }
}

