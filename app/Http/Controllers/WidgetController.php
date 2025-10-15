<?php

namespace App\Http\Controllers;

use App\Services\Customer\CustomerCommandService;
use App\Services\Customer\CustomerQueryService;
use App\Services\Ticket\TicketCommandService;
use App\Services\Ticket\TicketQueryService;
use Illuminate\Http\Request;

class WidgetController extends Controller
{
    public function __construct(
        protected CustomerCommandService $customerCommandService,
        protected CustomerQueryService $customerQueryService,
        protected TicketCommandService $ticketCommandService,
        protected TicketQueryService $ticketQueryService,
    ) {
    }
}
