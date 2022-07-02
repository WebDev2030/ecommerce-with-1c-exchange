<?php

namespace App\Catalog\OneCExchenge\XmlParsers;

use App\Catalog\Models\Category;

class BranchHandlerFactory
{
    public static function getBranchByName($branchName, $xml): BranchHandlerInterface|null
    {
        return match ($branchName) {
            'Группы' => new CategoryBranchHandler($xml),
            'ТипыЦен' => new PriceTypeBranchHandler($xml),
            'Склады' => new StoreBranchHandler($xml),
            'ЕдиницыИзмерения' => new UnitBranchHandler($xml),
            'Свойства' => new PropertyBranchHandler($xml),
            default => null,
        };
    }
}
