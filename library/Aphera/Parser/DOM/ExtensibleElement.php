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

class ExtensibleElement extends Element implements Model\ExtensibleElement
{
    /**
     * @var Factory
     */
    protected $factory;
    
    public function __construct ($name, $value, $uri, Factory $factory) {
        parent::__construct($name, $value, $uri);
        $this->factory = $factory;
    }

    public function setFactory(Factory $factory) {
        $this->factory = $factory;
    }
    
    /**
     * @param string $name
     * @param string $uri
     * @return Model\Element or null
     */
    public function getFirstChildByTagName($name, $uri = null) {
        $children = $this->getChildrenWithName($name, $uri);
        if(count($children)) {
            return $children[0];
        } else {
            return null;
        }
    }
    
    /**
     * @param string $name
     * @param string $uri
     * @return array of Model\Element
     */
    public function getChildrenWithName($name, $uri = null) {
        $children = array();
        foreach($this->childNodes as $node) {
            if($node->nodeType == \XML_ELEMENT_NODE && $node->localName == $name) {
                if($uri === null || $uri == $node->namespaceURI) {
                    $children[] = $node;
                }
            }
        }
        return $children;
    }

    public function removeChildren($name, $uri = null) {
        foreach($this->getChildrenWithName($name, $uri) as $child) {
            $this->removeChild($child);
        }
    }

    public function setChild(Model\ExtensibleElement $element) {
        $this->removeChildren($element->nodeName, $element->namespaceURI);
        $this->appendChild($element);
    }
}