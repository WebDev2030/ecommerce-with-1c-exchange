<?php

namespace App\Catalog\DTO;

use App\BaseDTO;

class CategoryDTO extends BaseDTO
{
    protected string $name;
    protected string $slug;
    protected bool $active;
    protected string $parentID;
    protected int $previewImageId;
    protected int $detailImageId;
    protected string $externalId = "";
    protected string $parentExternalId = "";
}
