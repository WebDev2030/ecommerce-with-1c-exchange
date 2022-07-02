<?php

namespace App\Models;

use App\Catalog\OneCExchenge\ImportFileParser;
use \Mavsan\LaProtocol\Interfaces\ImportBitrix;

class Import implements ImportBitrix
{
    public function modeComplete()
    {

    }

    public function modeDeactivate($startTime = null): string
    {
        return \Mavsan\LaProtocol\Interfaces\Import::answerSuccess;
    }

    public function import($filename): string
    {
        $parser = new ImportFileParser($filename);
        $parser->parse();

        return \Mavsan\LaProtocol\Interfaces\Import::answerSuccess;
    }
}
