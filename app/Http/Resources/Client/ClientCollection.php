<?php

namespace App\Http\Resources\Client;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use JsonSerializable;

class ClientCollection extends ResourceCollection
{
    public function toArray(Request $request): array|JsonSerializable|Arrayable
    {
        return $this->collection->map(function ($item) {
            return new ClientResource($item);
        });
    }
}
