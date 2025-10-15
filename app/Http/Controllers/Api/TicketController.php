<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Customer\{CustomerCommandService, CustomerQueryService};
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
}
