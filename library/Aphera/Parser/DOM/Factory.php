<?php
/**
 * Copyright 2011 Martin Vium
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
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

    /**
     * @return Core\Aphera
     */
    public function getAphera() {
        return $this->aphera;
    }

    /**
     * @return ExtensibleElement
     */
    public function newCategories() {
        return $this->newElement('categories', Core\Constants::ATOM_NS);
    }

    /**
     * @return ExtensibleElement
     */
    public function newCategory() {
        return $this->newElement('category', Core\Constants::ATOM_NS);
    }

    /**
     * @return Collection
     */
    public function newCollection(Model\ExtensibleElement $parent = null) {
        $collection = new Collection($this);
        if($parent) {
            $parent->appendChild($collection);
        }
        return $collection;
    }

    /**
     * @return Writer
     */
    public function newWriter() {
        return new Writer();
    }
    
    /**
     * @param Model\ExtensibleElement $parent
     * @return Content
     */
    public function newContent(Model\ExtensibleElement $parent = null) {
        $element = new Content($this);
        if($parent) {
            $parent->appendChild($element);
        }
        return $element;
    }

    /**
     * @return Document
     */
    public function newDocument() {
        return new Document($this->getAphera()->getFactory(), $this->version, $this->encoding);
    }
    
    /**
     * @param string $local
     * @param string $uri
     * @return ExtensibleElement
     */
    public function newElement($local, $uri = null) {
        return new ExtensibleElement($local, null, $uri, $this);
    }

    /**
     * @return Entry
     */
    public function newEntry(Model\ExtensibleElement $parent = null) {
        if(! $parent) {
            $parent = $this->newDocument();
        }
        
        $element = new Entry($this);
        $parent->appendChild($element);
        return $element;
    }

    /**
     * @return Source
     */
    public function newSource(Model\ExtensibleElement $parent = null) {
        $element = new Source(null, $this);
        if($parent) {
            $parent->appendChild($element);
        }
        return $element;
    }

    /**
     * @return Feed
     */
    public function newFeed() {
        $doc = $this->newDocument();
        $element = new Feed($this);
        $doc->appendChild($element);
        return $element;
    }

    /**
     * @return ExtensibleElement
     */
    public function newID() {
        return $this->newElement(Core\Constants::ID, Core\Constants::ATOM_NS);
    }

    /**
     * @return Link
     */
    public function newLink(Model\ExtensibleElement $parent = null) {
        $element =  $this->newElement(Core\Constants::LINK, Core\Constants::ATOM_NS);
        $element = new Link($this);
        if($parent) {
            $parent->appendChild($element);
        }
        return $element;
    }

    /**
     * @return Parser
     */
    public function newParser() {
        return new Parser($this->aphera);
    }

    /**
     * @return ExtensibleElement
     */
    public function newPublished() {
        return $this->newElement('published', Core\Constants::ATOM_NS);
    }

    /**
     * @return Service
     */
    public function newService() {
        $doc = $this->newDocument();
        $el = new Service($this);
        $doc->appendChild($el);
        return $el;
    }

    /**
     * @return ExtensibleElement
     */
    public function newSummary() {
        return $this->newElement(Core\Constants::SUMMARY, Core\Constants::ATOM_NS);
    }

    /**
     * @return ExtensibleElement
     */
    public function newTitle() {
        return $this->newElement(Core\Constants::TITLE, Core\Constants::ATOM_NS);
    }

    /**
     * @return ExtensibleElement
     */
    public function newUpdated() {
        return $this->newElement('updated', Core\Constants::ATOM_NS);
    }

    /**
     * @return Workspace
     */
    public function newWorkspace(Model\ExtensibleElement $parent = null) {
        $workspace = new Workspace($this);
        if($parent) {
            $parent->appendChild($workspace);
        }
        return $workspace;
    }
    
    public function registerExtension(Core\ExtensionFactory $factory) {
        
    }
}