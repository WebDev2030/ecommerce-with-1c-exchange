<?php

namespace App\Http\Controllers\Traites;

use Mavsan\LaProtocol\Interfaces\Import;
use App;
use Mavsan\LaProtocol\Interfaces\ImportBitrix;

trait ImportsCatalog
{
    use \Mavsan\LaProtocol\Http\Controllers\Traits\ImportsCatalog;

    protected function getImportModel()
    {
        $modelCLass = config('protocolExchange1C.catalogWorkModel');
        // проверка модели
        if (empty($modelCLass)) {
            return $this->failure('Mode: '.$this->stepImport
                .', please set model to import data in catalogWorkModel key.');
        }

        /** @var Import $model */
        $model = App::make($modelCLass);
        $isBitrix = config('protocolExchange1C.isBitrixOn1C', false);
        if (
            ($isBitrix && ! $model instanceof ImportBitrix)
            && ! $model instanceof Import
        ) {
            return $this->failure('Mode: '.$this->stepImport.' model '
                .$modelCLass
                .' must implement \Mavsan\LaProtocol\Interfaces\Import');
        }

        return $model;
    }
}
