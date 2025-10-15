<?php

declare(strict_types=1);

namespace App\Services\Ticket;

use App\Models\Ticket;
use App\Services\QueryService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class TicketQueryService extends QueryService
{
    public function getStatistics(): array
    {
        return [
            'today' => Ticket::createdToday()->count(),
            'week' => Ticket::createdThisWeek()->count(),
            'month' => Ticket::createdThisMonth()->count(),
        ];
    }

    public function get(array $data = [], array $with = []): LengthAwarePaginator
    {
        $query = $this->ticketRepository->getQuery($data);
        if (count($with) > 0) {
            $query->with(...$with);
        }

        return $query->orderBy('id', 'desc')->paginate(15);
    }

    public function first(int $id): Model|Collection|Ticket|null
    {
        return Ticket::with(['customer', 'media'])->findOrFail($id);
    }
}
