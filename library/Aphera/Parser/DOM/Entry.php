<?php
namespace Aphera\Parser\DOM;

use Aphera\Model;
use Aphera\Core;

class Entry extends ExtensibleElement implements Model\Entry
{
    protected $links = array();
    protected $content;
    protected $id;
    protected $summary;
    protected $title;

    public function __construct(Core\Factory $factory) {
        parent::__construct(Core\Constants::ENTRY, null, Core\Constants::ATOM_NS, $factory);
    }

    public function addLink($href, $rel = null, $title = null) {
        $link = $this->factory->newLink($this);
        $link->setHref($href);
        $link->setRel($rel);
        $link->setTitle($title);
    }

    public function getContent() {
        return $this->getContentElement()->getValue();
    }

    public function getContentElement() {
        $this->ownerDocument->registerNodeClass('\\DOMElement', '\\Aphera\\Parser\\DOM\\Element');
        $element = $this->getFirstChildByTagName(Core\Constants::CONTENT, Core\Constants::ATOM_NS);
        return $element;
    }

    public function getId() {
        return $this->getIdElement()->getValue();
    }

    public function getIdElement() {
        $this->ownerDocument->registerNodeClass('\\DOMElement', '\\Aphera\\Parser\\DOM\\Element');
        $element = $this->getFirstChildByTagName(Core\Constants::ID, Core\Constants::ATOM_NS);
        return $element;
    }

    public function getLinks($rel = null) {
        $this->ownerDocument->registerNodeClass('\\DOMElement', '\\Aphera\\Parser\\DOM\\Link');
        $elements = $this->getChildrenWithName(Core\Constants::LINK);
        
        if($rel !== null) {
            $elements = Helper::getElementsWithAttributeValue($elements, Core\Constants::REL, $rel, Core\Constants::ATOM_NS);
        }
        
        return $elements;
    }

    public function getSummary() {
        return $this->getSummaryElement()->getValue();
    }

    public function getSummaryElement() {
        $this->ownerDocument->registerNodeClass('\\DOMElement', '\\Aphera\\Parser\\DOM\\Element');
        $element = $this->getFirstChildByTagName(Core\Constants::SUMMARY, Core\Constants::ATOM_NS);
        return $element;
    }

    public function getTitle() {
        return $this->getTitleElement()->getValue();
    }

    public function getTitleElement() {
        $this->ownerDocument->registerNodeClass('\\DOMElement', '\\Aphera\\Parser\\DOM\\Element');
        $element = $this->getFirstChildByTagName(Core\Constants::TITLE, Core\Constants::ATOM_NS);
        return $element;
    }

    public function newId() {
        
    }

    public function setContent($value) {
        $content = $this->factory->newContent($this);
        $content->nodeValue = (string)$value;
    }

    public function setId($id) {
        $element = $this->factory->newID();
        $element->nodeValue = (string)$id;
        $this->appendChild($element);
    }

    public function setSummary($value) {
        $element = $this->factory->newSummary();
        $element->nodeValue = (string)$value;
        $this->appendChild($element);
    }

    public function setTitle($value) {
        $element = $this->factory->newTitle();
        $element->nodeValue = (string)$value;
        $this->appendChild($element);
    }
}