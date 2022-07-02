<?php

namespace App\Catalog\Repositories;

use App\Catalog\Models\Category;
use App\Repositories\BaseRepository;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    use WithExternalIDTrait;

    protected $model = Category::class;
}
