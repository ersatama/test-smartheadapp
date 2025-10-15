<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\Customer\CustomerRepositoryInterface;
use App\Repositories\Ticket\TicketRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;

abstract class CommandService
{
    public function __construct(
        protected UserRepositoryInterface $userRepository,
        protected TicketRepositoryInterface $ticketRepository,
        protected CustomerRepositoryInterface $customerRepository
    ) {
    }
}
