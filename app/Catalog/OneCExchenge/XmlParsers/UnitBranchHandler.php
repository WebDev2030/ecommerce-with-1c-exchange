<?php

namespace App\Catalog\OneCExchenge\XmlParsers;

use App\Catalog\Models\Unit;
use App\Catalog\Repositories\UnitRepository;
use SimpleXMLElement;

class UnitBranchHandler extends BranchHandler
{
    function handle()
    {
        $arStores = $this->parseUnits($this->xml);
        $this->saveUnits($arStores);
    }

    /**
     * Возвращает массив всех разделов
     * @param $xml
     * @param null $parent
     * @return array
     */
    private function parseUnits($xml): array
    {
        $arUnits = [];
        foreach($xml->children() as $child){
            /** @var SimpleXMLElement $child */

            $arChild = [
                'external_id' => (string)$child->Ид,
                'active' => !((string)$child->ПометкаУдаления == 'true'),
                'name_short' => (string)$child->НаименованиеКраткое,
                'name' => (string)$child->НаименованиеПолное,
                'code' => (string)$child->Код,
                'international_name' => (string)$child->МеждународноеСокращение,
            ];

            $arUnits[] = $arChild;
        }

        return ($arUnits);
    }

    private function saveUnits($arUnits)
    {
        foreach ($arUnits as $arUnit) {
            $this->saveUnit($arUnit);
        }
    }

    private function saveUnit($arUnit): bool
    {
        $unitRepository = new UnitRepository();

        if(!($unit = $unitRepository->getByExternalID($arUnit['external_id']))) {
            $unit = new Unit();
        }

        $unit->name = $arUnit['name'];
        $unit->name_short = $arUnit['name_short'];
        $unit->code = $arUnit['code'];
        $unit->international_name = $arUnit['international_name'];
        $unit->active = $arUnit['active'];
        $unit->external_id = $arUnit['external_id'];

        return $unit->save();
    }
}
