<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Ticket;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TicketApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_ticket_successfully()
    {
        $data = [
            'name' => 'Иван Иванов',
            'email' => 'ivan@example.com',
            'phone' => '+77001234567',
            'subject' => 'Ошибка оплаты',
            'text' => 'Не проходит оплата на сайте.',
        ];

        $response = $this->postJson('/api/tickets', $data);

        $response->assertStatus(201)
            ->assertJsonStructure(['data' => ['id', 'subject', 'status']]);

        $this->assertDatabaseHas('tickets', ['subject' => 'Ошибка оплаты']);
        $this->assertDatabaseHas('customers', ['email' => 'ivan@example.com']);
    }

    /** @test */
    public function it_validates_ticket_request()
    {
        $response = $this->postJson('/api/tickets', []);
        $response->assertStatus(400)
            ->assertJsonValidationErrors(['email', 'phone', 'subject']);
    }

    /** @test */
    public function it_returns_ticket_statistics()
    {
        Ticket::factory()->count(2)->create(['created_at' => now()]);
        Ticket::factory()->count(3)->create(['created_at' => now()->subDays(5)]);
        Ticket::factory()->count(5)->create(['created_at' => now()->subMonth()]);

        $response = $this->getJson('/api/tickets/statistics');

        $response->assertStatus(200)
            ->assertJsonStructure(['today', 'week', 'month']);
    }
}
