<?php
namespace Aphera\Parser\DOM;

use Aphera\Model;
use Aphera\Core;
use Aphera\Core\Constants;

class Entry extends ExtensibleElement implements Model\Entry
{
    protected $links = array();
    protected $content;
    protected $id;
    protected $summary;
    protected $title;

    public function __construct(Factory $factory) {
        parent::__construct(Constants::ENTRY, null, Constants::ATOM_NS, $factory);
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
        $element = $this->getFirstChildByTagName(Constants::CONTENT, Constants::ATOM_NS);
        return $element;
    }

    public function getId() {
        return $this->getIdElement()->getValue();
    }

    public function getIdElement() {
        $this->ownerDocument->registerNodeClass('\\DOMElement', '\\Aphera\\Parser\\DOM\\Element');
        $element = $this->getFirstChildByTagName(Constants::ID, Constants::ATOM_NS);
        return $element;
    }

    public function getLinks($rel = null) {
        $this->ownerDocument->registerNodeClass('\\DOMElement', '\\Aphera\\Parser\\DOM\\Link');
        $elements = $this->getChildrenWithName(Constants::LINK);
        
        if($rel !== null) {
            $elements = Helper::getElementsWithAttributeValue($elements, Constants::REL, $rel, Constants::ATOM_NS);
        }
        
        return $elements;
    }

    public function getSummary() {
        return $this->getSummaryElement()->getValue();
    }

    public function getSummaryElement() {
        $this->ownerDocument->registerNodeClass('\\DOMElement', '\\Aphera\\Parser\\DOM\\Element');
        $element = $this->getFirstChildByTagName(Constants::SUMMARY, Constants::ATOM_NS);
        return $element;
    }

    public function getTitle() {
        return $this->getTitleElement()->getValue();
    }

    public function getTitleElement() {
        $this->ownerDocument->registerNodeClass('\\DOMElement', '\\Aphera\\Parser\\DOM\\Element');
        $element = $this->getFirstChildByTagName(Constants::TITLE, Constants::ATOM_NS);
        return $element;
    }

    public function newId() {
        
    }

    public function setContent($value) {
        $this->factory->newContent($this)->nodeValue = (string)$value;
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

    public function getUpdatedElement() {
        $this->ownerDocument->registerNodeClass('\\DOMElement', '\\Aphera\\Parser\\DOM\\Element');
        $element = $this->getFirstChildByTagName(Constants::UPDATED, Constants::ATOM_NS);
        return $element;
    }

    public function getUpdated() {
        return new \DateTime($this->getUpdatedElement()->getValue());
    }

    public function setUpdated(\DateTime $datetime) {
        $element = $this->factory->newUpdated();
        $element->nodeValue = $datetime->format(Constants::DATE_FORMAT);
        $this->appendChild($element);
    }
}