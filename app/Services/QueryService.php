<?php

namespace App\Services;

use App\Repositories\Customer\CustomerRepositoryInterface;
use App\Repositories\Ticket\TicketRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;

abstract class QueryService
{
    public function __construct(
        protected UserRepositoryInterface $userRepository,
        protected TicketRepositoryInterface $ticketRepository,
        protected CustomerRepositoryInterface $customerRepository
    ) {
    }
}