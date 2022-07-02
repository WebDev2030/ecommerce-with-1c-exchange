<?php

namespace App\Catalog\OneCExchenge\XmlParsers;

abstract class BranchHandler implements BranchHandlerInterface
{
    protected \SimpleXMLElement $xml;

    public function __construct(\SimpleXMLElement $xml)
    {
        $this->xml = $xml;
    }
}
