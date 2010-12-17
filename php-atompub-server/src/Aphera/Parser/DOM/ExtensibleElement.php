<?php
namespace Aphera\Parser\DOM;

use Aphera\Model;
use Aphera\Core;

class ExtensibleElement extends Element implements Model\ExtensibleElement
{
    /**
     * @var Factory
     */
    protected $factory;
    
    public function __construct ($name, $value, $uri, Core\Factory $factory) {
        parent::__construct($name, $value, $uri);
        $this->factory = $factory;
    }
    
    /**
     * @param string $name
     * @param string $uri
     * @return Model\Element
     */
    protected function getFirstChildByTagName($name, $uri) {
        $el = null;
        foreach($this->childNodes as $node) {
            var_dump($node);
            if($node->nodeType == \XML_ELEMENT_NODE) {
                $el = $node;
            }
        }
        return $el;
    }
}