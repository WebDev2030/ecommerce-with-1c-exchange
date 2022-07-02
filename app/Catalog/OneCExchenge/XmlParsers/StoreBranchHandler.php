<?php

namespace App\Catalog\OneCExchenge\XmlParsers;

use App\Catalog\Models\Category;
use App\Catalog\Models\Store;
use App\Catalog\Repositories\StoreRepository;
use SimpleXMLElement;

class StoreBranchHandler extends BranchHandler
{
    public function handle() {
        $arStores = $this->parseStores($this->xml);
        $this->saveStores($arStores);
    }

    /**
     * Возвращает массив всех разделов
     * @param $xml
     * @param null $parent
     * @return array
     */
    private function parseStores($xml): array
    {
        $arStores = [];
        foreach($xml->children() as $child){
            /** @var SimpleXMLElement $child */

            $arChild = [
                'external_id' => (string)$child->Ид,
                'active' => !((string)$child->ПометкаУдаления == 'true'),
                'name' => (string)$child->Наименование,
            ];

            $arStores[] = $arChild;
        }

        return ($arStores);
    }

    private function saveStores($arStores)
    {
        foreach ($arStores as $arStore) {
            $this->saveStore($arStore);
        }
    }

    private function saveStore($arStore): bool
    {
        $storeRepository = new StoreRepository();

        if(!($store = $storeRepository->getByExternalID($arStore['external_id']))) {
            $store = new Store();
        }

        $store->name = $arStore['name'];
        $store->active = $arStore['active'];
        $store->external_id = $arStore['external_id'];

        return $store->save();
    }
}
