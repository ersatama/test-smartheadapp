<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Ticket>
 */
class TicketFactory extends Factory
{
    protected $model = Ticket::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_id' => Customer::factory(),
            'subject' => fake()->sentence(3),
            'text' => fake()->paragraph(3),
            'status' => fake()->randomElement(['new', 'in_progress', 'done']),
            'manager_reply_at' => fake()->optional()->dateTimeBetween('-2 days', 'now'),
        ];
    }
}
