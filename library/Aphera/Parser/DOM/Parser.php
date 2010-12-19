<?php
namespace Aphera\Parser\DOM;

use Aphera\Core;
use Aphera\Model;

class Parser implements Core\Parser
{
    /**
     * @var Core\Factory
     */
    protected $factory;
    
    public function __construct(Core\Factory $factory) {
        $this->factory = $factory;
    }
    
    /**
     * @param resource $handle 
     * @return Model\Document
     */
    public function parseStream($handle) {
        $xml = \stream_get_contents($handle);
        $doc = $this->parseString($xml);
        \fclose($handle);
        return $doc;
    }
    
    /**
     * @param string $xml
     * @return Model\Document
     */
    public function parseString($xml) {
        $doc = $this->factory->newDocument();
        $doc->loadXML($xml);
        return $doc;
    }
}