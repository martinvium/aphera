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
        return $this->newElement('categories', Core\Constants::ATOM_NS);
    }
    
    public function newCategory() {
        return $this->newElement('category', Core\Constants::ATOM_NS);
    }
    
    public function newCollection() {
        return $this->newElement('collection', Core\Constants::ATOM_NS);
    }
    
    public function newContent($type) {
        return $this->newElement(Core\Constants::CONTENT, Core\Constants::ATOM_NS);
    }
    
    public function newDocument() {
        return new Document($this->version, $this->encoding);
    }
    
    public function newElement($local, $uri = null) {
        return new ExtensibleElement($local, null, $uri, $this);
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
        return $this->newElement(Core\Constants::ID, Core\Constants::ATOM_NS);
    }
    
    public function newLink() {
        return $this->newElement('link', Core\Constants::ATOM_NS);
    }
    
    public function newParser() {
        return new Parser();
    }
    
    public function newPublished() {
        return $this->newElement('published', Core\Constants::ATOM_NS);
    }
    
    public function newService() {
        $doc = $this->newDocument();
        $el = $this->newElement('service', Core\Constants::ATOM_NS);
        $doc->appendChild($el);
        return $el;
    }
    
    public function newSummary() {
        return $this->newElement(Core\Constants::SUMMARY, Core\Constants::ATOM_NS);
    }
    
    public function newTitle() {
        return $this->newElement(Core\Constants::TITLE, Core\Constants::ATOM_NS);
    }
    
    public function newUpdated() {
        return $this->newElement('updated', Core\Constants::ATOM_NS);
    }
    
    public function newWorkspace() {
        return $this->newElement('workspace', Core\Constants::ATOM_NS);
    }
    
    public function registerExtension(Core\ExtensionFactory $factory) {
        
    }
}