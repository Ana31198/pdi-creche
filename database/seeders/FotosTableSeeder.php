<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Foto;
use App\Models\Crianca;

class FotosTableSeeder extends Seeder
{
    public function run()
    {
        $crianca = Crianca::first(); // só para exemplo — usa a primeira criança

        if (!$crianca) {
            echo "Nenhuma criança encontrada. Corre o CriancasTableSeeder primeiro.\n";
            return;
        }

        Foto::firstOrCreate(
            ['titulo' => 'Dia da Alegria'],
            [
                'crianca_id' => $crianca->id,
                'descricao' => 'Foto tirada durante o evento do Dia da Alegria.',
                'caminho' => 'fotos/exemplo.jpg',
            ]
        );

        Foto::firstOrCreate(
            ['titulo' => 'Brincadeiras no Parque'],
            [
                'crianca_id' => $crianca->id,
                'descricao' => 'Momento divertido no parquinho.',
                'caminho' => 'fotos/parque.jpg',
            ]
        );
    }
}
