<?php
namespace Aphera\Core;

use Aphera\Model\Document;

interface Parser
{
    /**
     * @param resource $handle 
     * @return Document
     */
    public function parseStream($handle);
    
    /**
     * @param string $xml
     * @return Document
     */
    public function parseString($xml);
}