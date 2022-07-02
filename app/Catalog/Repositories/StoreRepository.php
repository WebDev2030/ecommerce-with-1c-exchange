<?php

namespace App\Catalog\Repositories;

use App\Catalog\Models\PriceType;
use App\Catalog\Models\Store;
use App\Repositories\BaseRepository;


class StoreRepository extends BaseRepository implements PriceTypeRepositoryInterface
{
    use WithExternalIDTrait;

    /**
     * @var class-string
     */
    protected $model = Store::class;
}
