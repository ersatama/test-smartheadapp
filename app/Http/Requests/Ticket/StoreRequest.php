<?php

declare(strict_types=1);

namespace App\Http\Requests\Ticket;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    use Request;

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => ['required', 'regex:/^\+[1-9]\d{1,14}$/'],
            'subject' => 'required|string|max:255',
            'text' => 'required|string',
            'files.*' => 'nullable|file|max:2048',
        ];
    }
}
