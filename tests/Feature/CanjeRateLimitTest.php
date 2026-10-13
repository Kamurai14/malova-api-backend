<?php

namespace Tests\Feature;

use Tests\TestCase;

class CanjeRateLimitTest extends TestCase
{
    public function test_bloquea_multiples_intentos_de_canje_rapidos()
    {
        // Datos falsos para intentar hacer el canje
        $datosCanje = [
            'afiliado_id' => 1,
            'recompensa_id' => 1,
        ];

        // Simulamos 3 peticiones permitidas en menos de un minuto
        $this->postJson('/api/canjear', $datosCanje);
        $this->postJson('/api/canjear', $datosCanje);
        $this->postJson('/api/canjear', $datosCanje);

        // La cuarta petición DEBE ser bloqueada por el servidor
        $respuesta = $this->postJson('/api/canjear', $datosCanje);

        // Afirmamos (Assert) que el servidor nos batea con un error 429 (Too Many Requests)
        $respuesta->assertStatus(429);
    }
}