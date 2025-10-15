<?php

declare(strict_types=1);

namespace App\Repositories\Ticket;

use App\Models\Ticket;

class TicketRepository implements TicketRepositoryInterface
{
    public function getQuery(array $data = [])
    {
        $query = Ticket::query();
        if (isset($data['status'])) {
            $query->where('status', $data['status']);
        }

        if (isset($data['email'])) {
            $query->whereHas(
                'customer',
                fn ($q) => $q->where('email', 'ILIKE', "%{$data['email']}%")
            );
        }

        if (isset($data['phone'])) {
            $query->whereHas(
                'customer',
                fn ($q) => $q->where('phone', 'ILIKE', "%{$data['phone']}%")
            );
        }

        if (isset($data['from']) && isset($data['to'])) {
            $query->whereBetween('created_at', [$data['from'], $data['to']]);
        }

        return $query;
    }
}
