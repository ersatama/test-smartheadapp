<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ticket\IndexRequest;
use App\Services\Customer\{CustomerCommandService, CustomerQueryService};
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
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
    public function index(IndexRequest $request): Factory|View
    {
        $data = $request->checked();
        $tickets = $this->ticketQueryService->get($data);
        return view('admin.tickets.index', compact('tickets'));
    }
}
