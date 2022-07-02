<?php

namespace App\Catalog\Repositories;

use App\Catalog\Models\PriceType;
use App\Repositories\BaseRepository;


class PriceTypeRepository extends BaseRepository implements PriceTypeRepositoryInterface
{
    use WithExternalIDTrait;

    /**
     * @var class-string
     */
    protected $model = PriceType::class;
}
