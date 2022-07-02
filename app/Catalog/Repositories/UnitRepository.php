<?php

namespace App\Catalog\Repositories;

use App\Catalog\Models\PriceType;
use App\Catalog\Models\Unit;
use App\Repositories\BaseRepository;


class UnitRepository extends BaseRepository implements UnitRepositoryInterface
{
    use WithExternalIDTrait;

    /**
     * @var class-string
     */
    protected $model = Unit::class;
}
