<?php
use App\Models\User;
use App\Models\Crianca;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PresencaTest extends TestCase
{
    use RefreshDatabase;

    public function test_educador_pode_criar_presenca()
    {
        $educador = User::factory()->create(['role' => 'educador']);
        $crianca = Crianca::factory()->create();

        $this->actingAs($educador)
            ->post('/presencas', [
                'crianca_id' => $crianca->id,
                'data' => now()->toDateString(),
                'hora' => '09:00',
                'responsavel' => 'Mãe da criança',
            ])
            ->assertRedirect('/presencas');

        $this->assertDatabaseHas('presencas', [
            'crianca_id' => $crianca->id,
            'responsavel' => 'Mãe da criança',
        ]);
    }
}