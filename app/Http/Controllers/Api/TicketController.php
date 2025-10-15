<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ticket\StoreRequest;
use App\Http\Resources\Ticket\TicketResource;
use App\Http\Resources\Ticket\TicketStatisticsResource;
use App\Services\Customer\CustomerCommandService;
use App\Services\Customer\CustomerQueryService;
use App\Services\Ticket\TicketCommandService;
use App\Services\Ticket\TicketQueryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class TicketController extends Controller
{
    public function __construct(
        protected CustomerCommandService $customerCommandService,
        protected CustomerQueryService $customerQueryService,
        protected TicketCommandService $ticketCommandService,
        protected TicketQueryService $ticketQueryService,
    ) {
    }

    /**
     * @throws ValidationException
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $data = $request->checked();
        $ticket = $this->ticketCommandService->create($data, $request->file('files'));

        return response()->json([
            'message' => 'Заявка успешно отправлена!',
            'data' => new TicketResource($ticket),
        ], 201);
    }

    public function statistics(): JsonResponse
    {
        $stats = $this->ticketQueryService->getStatistics();

        return response()->json(new TicketStatisticsResource($stats));
    }
}
