<?php

declare(strict_types=1);

namespace Tests\Feature\Admin;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class TicketStatusTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function manager_can_update_ticket_status()
    {
        Role::create(['name' => 'manager']);

        $manager = User::factory()->create();
        $manager->assignRole('manager');

        $ticket = Ticket::factory()->create(['status' => 'new']);

        $response = $this->actingAs($manager)
            ->patch(route('admin.tickets.updateStatus', $ticket->id), [
                'status' => 'done',
            ]);

        $response->assertRedirect(route('admin.tickets.show', $ticket->id));
        $this->assertDatabaseHas('tickets', [
            'id' => $ticket->id,
            'status' => 'done',
        ]);
    }

    /** @test */
    public function guest_cannot_update_ticket_status()
    {
        $ticket = Ticket::factory()->create(['status' => 'new']);

        $this->patchJson(route('admin.tickets.updateStatus', $ticket->id), [
            'status' => 'done',
        ])->assertStatus(401);
    }
}
