<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Crianca;

class CriancasTableSeeder extends Seeder
{
    public function run()
    {
        Crianca::firstOrCreate(
            ['nome' => 'Martim'],
            [
                'data_nascimento' => '2020-06-15',
                'genero' => 'Masculino',
                'nomeresponsavel' => 'Ana ',
                'graudeparentescodoresponsavel' => 'Mãe',
                'contactodoresponsavel' => '912345678',
                'image' => 'img/criancas/martim.jpg',
            ]
        );

        Crianca::firstOrCreate(
            ['nome' => 'João '],
            [
                'data_nascimento' => '2019-11-03',
                'genero' => 'Masculino',
                'nomeresponsavel' => 'Ana ',
                'graudeparentescodoresponsavel' => 'Mãe',
                'contactodoresponsavel' => '913456789',
                'image' => 'img/criancas/joao.jpg',
            ]
        );
    }
}
