<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ticket\IndexRequest;
use App\Http\Requests\Ticket\StatusRequest;
use App\Services\Customer\CustomerCommandService;
use App\Services\Customer\CustomerQueryService;
use App\Services\Ticket\TicketCommandService;
use App\Services\Ticket\TicketQueryService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
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
    public function index(IndexRequest $request): Factory|View
    {
        $data = $request->checked();
        $tickets = $this->ticketQueryService->get($data);

        return view('admin.tickets.index', compact('tickets'));
    }

    public function show(int $id): Factory|View
    {
        $ticket = $this->ticketQueryService->first($id);

        return view('admin.tickets.show', compact('ticket'));
    }

    /**
     * @throws ValidationException
     */
    public function updateStatus(StatusRequest $request, int $id): RedirectResponse
    {
        $data = $request->checked();
        $ticket = $this->ticketQueryService->first($id);
        $this->ticketCommandService->update($ticket, [
            'status' => $data['status'],
            'manager_reply_at' => now(),
        ]);

        return redirect()
            ->route('admin.tickets.show', $ticket->id)
            ->with('success', 'Статус успешно обновлён');
    }
}
