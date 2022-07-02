<?php

namespace App\Catalog\Repositories;

use App\Catalog\Models\Category;
use App\Catalog\Models\Currency;


class CurrencyRepository implements CurrencyRepositoryInterface
{
    public function getByCode($code = 'KZT'): \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Builder|Currency|null
    {
        return Currency::whereCode($code)->first();
    }
}
