<?php

namespace App\Catalog\OneCExchenge;

use App\Catalog\OneCExchenge\XmlParsers\BranchHandlerFactory;
use SimpleXMLElement;

class ImportFileParser
{
    /**
     * @var string
     */
    private $filpath = '';

    public function __construct(string $filepath)
    {
        $this->filpath = $filepath;
    }

    public function parse()
    {
        $xml = simplexml_load_file($this->filpath);
        $this->parseXml($xml->Классификатор);
    }

    public function parseXml(SimpleXMLElement $xml)
    {
        foreach($xml->children() as $childName => $child){
            $branchHandler = BranchHandlerFactory::getBranchByName($childName, $child);
            if($branchHandler) {
                $branchHandler->handle();
            }
        }
    }
}
