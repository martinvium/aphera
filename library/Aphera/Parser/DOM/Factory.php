<?php
namespace Aphera\Parser\DOM;

use Aphera\Core;
use Aphera\Model;

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
    
    /**
     * @param Model\ExtensibleElement $parent
     * @return type 
     */
    public function newContent(Model\ExtensibleElement $parent = null) {
        $element = new Content($this);
        if($parent) {
            $parent->appendChild($element);
        }
        return $element;
    }
    
    public function newDocument() {
        return new Document($this->version, $this->encoding);
    }
    
    /**
     * @param string $local
     * @param string $uri
     * @return ExtensibleElement
     */
    public function newElement($local, $uri = null) {
        return new ExtensibleElement($local, null, $uri, $this);
    }
    
    public function newEntry(Model\ExtensibleElement $parent = null) {
        if(! $parent) {
            $parent = $this->newDocument();
        }
        
        $el = new Entry($this);
        $parent->appendChild($el);
        return $el;
    }
    
    public function newFeed() {
        $doc = $this->newDocument();
        $el = new Feed($this);
        $doc->appendChild($el);
        return $el;
    }
    
    public function newID() {
        return $this->newElement(Core\Constants::ID, Core\Constants::ATOM_NS);
    }
    
    public function newLink(Model\ExtensibleElement $parent = null) {
        $element =  $this->newElement(Core\Constants::LINK, Core\Constants::ATOM_NS);
        $element = new Link($this);
        if($parent) {
            $parent->appendChild($element);
        }
        return $element;
    }
    
    public function newParser() {
        return new Parser($this);
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