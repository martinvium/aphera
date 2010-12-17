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
        parent::__construct('entry', null, Core\Constants::ATOM_NS, $factory);
    }

    public function addLink($href, $rel = null, $title = null) {
        
    }

    public function getContent() {
        return $this->getContentElement()->nodeValue;
    }

    public function getContentElement() {
        $element = $this->getFirstChildByTagName(Core\Constants::CONTENT, Core\Constants::ATOM_NS);
        return $this->factory->newContentFromDOM($element);
    }

    public function getId() {
        
    }

    public function getIdElement() {
        $element = $this->getFirstChildByTagName(Core\Constants::ID, Core\Constants::ATOM_NS);
        return $this->factory->newIdFromDOM($element);
    }

    public function getLinks() {
        
    }

    public function getSummary() {
        return $this->getSummaryElement()->nodeValue;
    }

    public function getSummaryElement() {
        $element = $this->getFirstChildByTagName(Core\Constants::SUMMARY, Core\Constants::ATOM_NS);
        return $this->factory->newSummaryFromDOM($element);
    }

    public function getTitle() {
        return $this->getTitleElement()->nodeValue;
    }

    public function getTitleElement() {
        $element = $this->getFirstChildByTagName(Core\Constants::TITLE, Core\Constants::ATOM_NS);
        return $this->factory->newTitleFromDOM($element);
    }

    public function newId() {
        
    }

    public function setContent($value) {
        $content = $this->factory->newContent('text');
        $content->nodeValue = (string)$value;
        $this->appendChild($content);
    }

    public function setId($id) {
        
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