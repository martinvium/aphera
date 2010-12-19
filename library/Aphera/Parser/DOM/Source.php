<?php
namespace Aphera\Parser\DOM;

use Aphera\Model;
use Aphera\Core;

class Source extends ExtensibleElement implements Model\Source
{
    public function __construct($name = null, Core\Factory $factory = null) {
        if($name === null) {
            $name = Core\Constants::SOURCE;
        }
        
        parent::__construct($name, null, Core\Constants::ATOM_NS, $factory);
    }
    
    public function addLink($href, $rel = null, $title = null) {
        $link = $this->factory->newLink($this);
        $link->setHref($href);
        $link->setRel($rel);
        $link->setTitle($title);
    }
    
    public function getId() {
        return $this->getIdElement()->getValue();
    }

    public function getIdElement() {
        $this->ownerDocument->registerNodeClass('DOMElement', '\\Aphera\\Parser\\DOM\\Element');
        $element = $this->getFirstChildByTagName(Core\Constants::ID, Core\Constants::ATOM_NS);
        return $element;
    }

    public function getLinks($rel = null) {
        $this->ownerDocument->registerNodeClass('DOMElement', '\\Aphera\\Parser\\DOM\\Link');
        $elements = $this->getChildrenWithName(Core\Constants::LINK);
        
        if($rel !== null) {
            $elements = Helper::getElementsWithAttributeValue($elements, Core\Constants::REL, $rel, Core\Constants::ATOM_NS);
        }
        
        return $elements;
    }
    
    public function getTitle() {
        return $this->getTitleElement()->getValue();
    }

    public function getTitleElement() {
        $this->ownerDocument->registerNodeClass('DOMElement', '\\Aphera\\Parser\\DOM\\Element');
        $element = $this->getFirstChildByTagName(Core\Constants::TITLE, Core\Constants::ATOM_NS);
        return $element;
    }
    
    public function setId($id) {
        $element = $this->factory->newID();
        $element->nodeValue = (string)$id;
        $this->appendChild($element);
    }
    
    public function setTitle($value) {
        $element = $this->factory->newTitle();
        $element->nodeValue = (string)$value;
        $this->appendChild($element);
    }
}