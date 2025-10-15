<?php

namespace App\Http\Requests\Ticket;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class StatusRequest extends FormRequest
{
    use Request;

    public function rules(): array
    {
        return [
            'status' => 'required|in:new,in_progress,done',
        ];
    }
}
