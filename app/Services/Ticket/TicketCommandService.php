<?php

declare(strict_types=1);

namespace App\Services\Ticket;

use App\Services\CommandService;
use Illuminate\Support\Facades\DB;

class TicketCommandService extends CommandService
{
    public function create(array $data, ?array $files)
    {
        return DB::transaction(function () use ($data, $files) {
            $customer = $this->customerRepository->firstOrCreate(
                ['email' => $data['email']],
                ['name' => $data['name'], 'phone' => $data['phone']]
            );
            $ticket = $customer->tickets()->create([
                'subject' => $data['subject'],
                'text'    => $data['text'],
                'status'  => 'new',
            ]);
            if ($files) {
                foreach ($files as $file) {
                    $ticket->addMedia($file)->toMediaCollection('attachments');
                }
            }
            return $ticket;
        });
    }
}
