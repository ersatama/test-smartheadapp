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
}