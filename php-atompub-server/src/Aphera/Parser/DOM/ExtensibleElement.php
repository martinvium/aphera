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
     * @return Model\Element or null
     */
    public function getFirstChildByTagName($name, $uri = null) {
        $children = $this->getChildrenWithName($name, $uri);
        if(count($children)) {
            return $children[0];
        } else {
            return null;
        }
    }
    
    /**
     * @param string $name
     * @param string $uri
     * @return array of Model\Element
     */
    public function getChildrenWithName($name, $uri = null) {
        $children = array();
        foreach($this->childNodes as $node) {
            if($node->nodeType == \XML_ELEMENT_NODE && $node->localName == $name) {
                if($uri === null || $uri == $node->namespaceURI) {
                    $children[] = $node;
                }
            }
        }
        return $children;
    }
    
    /**
     *
     * @param array $elements
     * @param string $name
     * @param string $value
     * @param string $namespaceUri
     * @return array of Model\Element
     */
    public function getFilteredElementsByAttribute(array $elements, $name, $value, $namespaceUri) {
        $filteredElements = array();
        foreach($elements as $element) {
            if($element->getAttributeNS($namespaceUri, $name) == $value) {
                $filteredElements[] = $element;
            }
        }
        
        return $filteredElements;
    }
}