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
            'responsavel' => 'Ana',  
        ]);

       
     

      
    
    
    }
}

