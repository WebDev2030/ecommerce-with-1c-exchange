<?php

namespace App\Http\Controllers;

use Mavsan\LaProtocol\Http\Controllers\CatalogController;
use App\Http\Controllers\Traites\ImportsCatalog;
use Mavsan\LaProtocol\Http\Controllers\Traits\SharesSale;
use Mavsan\LaProtocol\Model\FileName;
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

    /**
     * Получение файла(ов)
     * @return string
     */
    protected function getFile()
    {
        $modelFileName = new FileName($this->request->input('filename'));
        $fileName = $modelFileName->getFileName();

        if (empty($fileName)) {
            return $this->failure('Mode: '.$this->stepFile
                .', parameter filename is empty');
        }

        $fullPath = $this->getFullPathToFile($fileName, false);

        $fData = $this->getFileGetData();

        if (empty($fData)) {
            return $this->failure('Mode: '.$this->stepFile
                .', input data is empty.');
        }

        if ($file = fopen($fullPath, 'ab')) {
            $dataLen = mb_strlen($fData, 'latin1');
            $result = fwrite($file, $fData);

            if ($result === $dataLen) {
                // файлы, требующие распаковки
                $files = [];

                if ($this->canUseZip()) {
                    $files = session('inputZipped', []);
                    $files[$fileName] = $fullPath;
                }

                session(['inputZipped' => $files]);

                return $this->success();
            }

            $this->failure('Mode: '.$this->stepFile
                .', can`t wrote data to file: '.$fullPath);
        } else {
            return $this->failure('Mode: '.$this->stepFile.', cant open file: '
                .$fullPath.' to write.');
        }

        return $this->failure('Mode: '.$this->stepFile.', unexpected error.');
    }
}
