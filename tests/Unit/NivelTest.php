<?php

namespace Tests\Feature;

use App\Models\Nivel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NivelTest extends TestCase
{
    //use RefreshDatabase;

    public function testNivelCreation()
    {
        $nivel = Nivel::factory()->create([
            'nivel' => 'Novo Nível'
        ]);

        $this->assertDatabaseHas('niveis', [
            'nivel' => 'Novo Nível'
        ]);
    }
}
