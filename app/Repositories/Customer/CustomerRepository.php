<?php

declare(strict_types=1);

namespace App\Repositories\Customer;

use App\Models\Customer;

class CustomerRepository implements CustomerRepositoryInterface
{
    public function firstOrCreate(array $search, array $create = [])
    {
        return Customer::firstOrCreate($search, $create);
    }
}
