<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ticket\StoreRequest;
use App\Http\Resources\Ticket\TicketResource;
use App\Services\Customer\{CustomerCommandService, CustomerQueryService};
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use App\Services\Ticket\{TicketCommandService, TicketQueryService};

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
}
