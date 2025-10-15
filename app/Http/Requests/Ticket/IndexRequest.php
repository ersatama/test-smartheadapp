<?php

declare(strict_types=1);

namespace App\Http\Requests\Ticket;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
{
    use Request;

    public function rules(): array
    {
        return [
            'status' => 'nullable|in:new,in_progress,done',
            'email' => 'nullable|email|max:255',
            'phone' => ['nullable', 'regex:/^\+[1-9]\d{1,14}$/'],
            'from' => 'nullable|date',
            'to' => 'nullable|date|after_or_equal:from',
        ];
    }

    public function validatedFilters(): array
    {
        return array_filter($this->validated(), fn ($value) => $value !== null);
    }
}
