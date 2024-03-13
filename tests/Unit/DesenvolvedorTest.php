<?php

namespace Tests\Feature;

use App\Models\Desenvolvedor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DesenvolvedorTest extends TestCase
{
    //use RefreshDatabase;

    public function testDesenvolvedorCreation()
    {
        $desenvolvedor = Desenvolvedor::factory()->create([
            'nome' => 'Novo Desenvolvedor',
            'sexo' => 'M',
            'datanascimento' => '1990-01-01',
            'hobby' => 'Programação'
        ]);

        $this->assertDatabaseHas('desenvolvedores', [
            'nome' => 'Novo Desenvolvedor'
        ]);
    }
}
