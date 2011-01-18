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
use Aphera\Core\Constants;

class Collection extends ExtensibleElement implements Model\Collection
{
    public function __construct(Factory $factory) {
        parent::__construct(Constants::COLLECTION, null, Constants::APP_NS, $factory);
    }

    public function getResolvedHref() {
        throw new \Exception('not implemented');
    }

    public function getTitle() {
        return $this->getTitleElement()->getValue();
    }

    private function getTitleElement() {
        $this->ownerDocument->registerNodeClass('DOMElement', '\\Aphera\\Parser\\DOM\\Element');
        $element = $this->getFirstChildByTagName(Constants::TITLE, Constants::ATOM_NS);
        return $element;
    }

    public function setTitle($value) {
        $element = $this->factory->newTitle();
        $element->nodeValue = (string)$value;
        $this->appendChild($element);
    }

    public function getHref() {
        return $this->getAttribute(Constants::HREF);
    }

    public function setHref($value) {
        $this->setAttribute(Constants::HREF, $value);
    }

    public function setAccept(array $accepts) {
        $this->removeChildren(Constants::ACCEPT);
        foreach($accepts as $accept) {
            $element = $this->factory->newElement(Constants::ACCEPT, Constants::APP_NS);
            $element->nodeValue = (string)$accept;
            $this->appendChild($element);
        }
    }

    public function getAccept() {
        $accept = array();
        $children = $this->getChildrenWithName(Constants::ACCEPT, Constants::APP_NS);
        foreach($children as $child) {
            $accept[] = (string)$child->nodeValue;
        }
        return $accept;
    }
}