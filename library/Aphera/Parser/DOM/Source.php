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