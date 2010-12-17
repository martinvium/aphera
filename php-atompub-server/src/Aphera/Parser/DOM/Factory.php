<?php
namespace Aphera\Parser\DOM;

use Aphera\Core;

/**
 * http://svn.apache.org/repos/asf/abdera/java/trunk/parser/src/main/java/org/apache/abdera/parser/stax/FOMFactory.java
 */
class Factory implements Core\Factory
{
    protected $aphera;
    protected $encoding = 'utf-8';
    protected $version = '1.0';
    
    public function __construct(Core\Aphera $aphera) {
        $this->aphera = $aphera;
    }
    
    public function getAphera() {
        return $this->aphera;
    }
    
    public function newCategories() {
        return $this->newElement('categories');
    }
    
    public function newCategory() {
        return $this->newElement('category');
    }
    
    public function newCollection() {
        return $this->newElement('collection');
    }
    
    public function newContent($type) {
        return $this->newElement(Core\Constants::CONTENT);
    }
    
    public function newContentFromDOM(\DOMElement $domElement) {
        \assert($domElement->localName == Core\Constants::CONTENT);
        return $this->newElementFromDOM($domElement);
    }
    
    public function newDocument() {
        return new Document($this->version, $this->encoding);
    }
    
    public function newElement($local, $uri = null) {
        return new Element($local, null, $uri, $this);
    }
    
    protected function newElementFromDOM(\DOMElement $domElement) {
        return new Element($domElement->localName, $domElement->nodeValue, $domElement->namespaceURI, $this);
    }
    
    public function newEntry() {
        $doc = $this->newDocument();
        $el = new Entry($this);
        $doc->appendChild($el);
        return $el;
    }
    
    public function newFeed() {
        $doc = $this->newDocument();
        $el = $this->newElement('feed');
        $doc->appendChild($el);
        return $el;
    }
    
    public function newID() {
        return $this->newElement(Core\Constants::ID);
    }
    
    public function newIdFromDOM(\DOMElement $domElement) {
        \assert($domElement->localName == Core\Constants::ID);
        return $this->newElementFromDOM($domElement);
    }
    
    public function newLink() {
        return $this->newElement('link');
    }
    
    public function newParser() {
        return new Parser();
    }
    
    public function newPublished() {
        return $this->newElement('published');
    }
    
    public function newService() {
        $doc = $this->newDocument();
        $el = $this->newElement('service');
        $doc->appendChild($el);
        return $el;
    }
    
    public function newSummary() {
        return $this->newElement(Core\Constants::SUMMARY);
    }
    
    public function newSummaryFromDOM(\DOMElement $domElement) {
        \assert($domElement->localName == Core\Constants::SUMMARY);
        return $this->newElementFromDOM($domElement);
    }
    
    public function newTitle() {
        return $this->newElement(Core\Constants::TITLE);
    }
    
    public function newTitleFromDOM(\DOMElement $domElement) {
        \assert($domElement->localName == Core\Constants::TITLE);
        return $this->newElementFromDOM($domElement);
    }
    
    public function newUpdated() {
        return $this->newElement('updated');
    }
    
    public function newWorkspace() {
        return $this->newElement('workspace');
    }
    
    public function registerExtension(Core\ExtensionFactory $factory) {
        
    }
}