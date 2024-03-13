<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Desenvolvedor;
use App\Models\Nivel;

class DesenvolvedorSeeder extends Seeder
{
    public function run()
    {
        $nivel1 = Nivel::where('nivel', 'Iniciante')->first();
        $nivel2 = Nivel::where('nivel', 'Intermediário')->first();

        Desenvolvedor::create([
            'nivel_id' => $nivel1->id,
            'nome' => 'João',
            'sexo' => 'M',
            'datanascimento' => '1990-01-01',
            'hobby' => 'Programação'
        ]);

        Desenvolvedor::create([
            'nivel_id' => $nivel2->id,
            'nome' => 'Maria',
            'sexo' => 'F',
            'datanascimento' => '1995-02-15',
            'hobby' => 'Violão'
        ]);
    }
}
