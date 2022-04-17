<?php

namespace App\Http\Controllers;

use Mavsan\LaProtocol\Http\Controllers\CatalogController;
use App\Http\Controllers\Traites\ImportsCatalog;
use Mavsan\LaProtocol\Http\Controllers\Traits\SharesSale;
use Session;

class Exchenge extends CatalogController
{
    use SharesSale;
    use ImportsCatalog;

    function checkCSRF($mode)
    {
        if (!config('protocolExchange1C.isBitrixOn1C', false)
            || $mode === $this->stepCheckAuth) {
            return true;
        }

        // 1С-Битрикс пихает CSRF в любое место запроса, тоэтому только перебором
        $arData = $this->request->all();
        $sessionTocken = Session::token();
        foreach ($arData as $key => $item) {
            if ($key === $sessionTocken) {
                return true;
            }
        }

        return false;
    }
}
