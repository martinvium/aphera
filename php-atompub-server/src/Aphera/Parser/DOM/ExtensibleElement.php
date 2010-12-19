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
    public function getFirstChildByTagName($name, $uri = null) {
        $el = null;
        foreach($this->childNodes as $node) {
            if($node->nodeType == \XML_ELEMENT_NODE && $node->localName == $name) {
                var_dump($node->namespaceURI);
                if($uri === null || $uri == $node->namespaceURI) {
                    $el = $node;
                }
            }
        }
        return $el;
    }
}