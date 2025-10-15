<?php

namespace App\Http\Resources\Ticket;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketStatisticsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'today' => $this['today'] ?? 0,
            'week'  => $this['week'] ?? 0,
            'month' => $this['month'] ?? 0,
        ];
    }
}
