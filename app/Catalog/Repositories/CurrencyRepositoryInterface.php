<?php

namespace App\Catalog\Repositories;

interface CurrencyRepositoryInterface
{
    public function getByCode($code = 'KZT');
}
