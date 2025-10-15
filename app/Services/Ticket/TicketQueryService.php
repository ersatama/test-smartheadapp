<?php

declare(strict_types=1);

namespace App\Services\Ticket;

use App\Models\Ticket;
use App\Services\QueryService;

class TicketQueryService extends QueryService
{
    public function getStatistics(): array
    {
        return [
            'today' => Ticket::createdToday()->count(),
            'week'  => Ticket::createdThisWeek()->count(),
            'month' => Ticket::createdThisMonth()->count(),
        ];
    }

    public function get(array $data = [], array $with = [])
    {
        $query = $this->ticketRepository->getQuery($data);
        if (count($with) > 0) {
            $query->with(...$with);
        }
        return $query->latest()->paginate(15);
    }
}