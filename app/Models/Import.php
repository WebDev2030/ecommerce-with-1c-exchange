<?php

namespace App\Models;

use \Mavsan\LaProtocol\Interfaces\ImportBitrix;

class Import implements ImportBitrix
{
    public function modeComplete()
    {

    }

    public function modeDeactivate($startTime = null): string
    {
//        return \Mavsan\LaProtocol\Interfaces\Import::answerFailure;
        return \Mavsan\LaProtocol\Interfaces\Import::answerSuccess;
    }

    public function import($filename)
    {
        var_dump($filename);
    }
}
