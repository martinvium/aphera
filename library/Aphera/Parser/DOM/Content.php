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

class Content extends ExtensibleElement implements Model\Content
{
    private $xmlTypes = array('xhtml', 'xml');
    
    public function __construct(Core\Factory $factory) {
        parent::__construct(Core\Constants::CONTENT, null, Core\Constants::ATOM_NS, $factory);
    }
    
    public function getContentType() {
        return $this->getAttributeNS(Core\Constants::ATOM_NS, Core\Constants::TYPE);
    }
    
    public function setContentType($type) {
        $this->setAttributeNS(Core\Constants::ATOM_NS, Core\Constants::TYPE, $type);
    }
    
    public function getSrc() {
        return $this->getAttributeNS(Core\Constants::ATOM_NS, Core\Constants::SRC);
    }
    
    public function getResolvedSrc() {
        throw new \Exception('not implemented');
    }
    
    public function setSrc($src) {
        $this->setAttributeNS(Core\Constants::ATOM_NS, Core\Constants::SRC, $src);
    }
    
    public function setValue($value) {
        $this->nodeValue = (string)$value;
    }
    
    public function getValueElement() {
        $this->ownerDocument->registerNodeClass('DOMElement', 'Aphera\\Parser\\DOM\\Element');
        if(in_array($this->getContentType(), $this->xmlTypes)) {
            return $this->firstChild;
        } else {
            return null;
        }
    }
    
    public function setValueElement(Model\Element $element) {
        $this->appendChild($element);
    }
}