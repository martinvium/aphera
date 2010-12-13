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
    
    public function __construct(Core\Aphera $aphera)
    {
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
        return $this->newElement('content');
    }
    
    public function newDocument() {
        return new Document($this->version, $this->encoding);
    }
    
    public function newElement($local, $uri) {
        return new Element($local, null, $uri);
    }
    
    public function newEntry() {
        $doc = $this->newDocument();
        $el = $this->newElement('entry');
        $doc->appendChild($el);
        return $el;
    }
    
    public function newExtensionElement($local, $uri) {
        return new Element($local, null, $uri);
    }
    
    public function newFeed() {
        $doc = $this->newDocument();
        $el = $this->newElement('feed');
        $doc->appendChild($el);
        return $el;
    }
    
    public function newID() {
        return $this->newElement('id');
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
        return $this->newElement('summary');
    }
    
    public function newTitle() {
        return $this->newElement('title');
    }
    
    public function newUpdated() {
        return $this->newElement('updated');
    }
    
    public function newWorkspace() {
        return $this->newElement('workspace');
    }
    
    public function registerExtension(ExtensionFactory $factory) {
        
    }
}