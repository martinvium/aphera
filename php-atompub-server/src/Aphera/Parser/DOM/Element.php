<?php
namespace Aphera\Parser\DOM;

use Aphera\Model;
use Aphera\Core;

class Element extends \DOMElement implements Model\Element
{
    /**
     * @var \DOMDocument
     */
    protected $ownerDocument;
    
    public function __construct ($name, $value, $uri) {
        parent::__construct($name, $value, $uri);
    }
    
    public function getTagName() {
        return $this->tagName;
    }
    
    public function getValue() {
        return $this->nodeValue;
    }

    /**
     * @return Core\Factory
     */
    public function getFactory() {
        return $this->factory;
    }

    public function writeTo(Core\Writer $out) {
        throw new Exception('not implemented');
    }
}