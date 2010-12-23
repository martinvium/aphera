<?php
namespace Aphera\Parser\DOM;

use Aphera\Core;
use Aphera\Model;

class Writer implements Core\Writer
{
    public function writeTo(Model\ExtensibleElement $element, $stream) {
        $element->ownerDocument->formatOutput = false;
        $xml = $element->ownerDocument->saveXML();
        \fputs($stream, $xml);
    }
}