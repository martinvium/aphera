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

class Link extends ExtensibleElement implements Model\Link
{
    public function __construct(Core\Factory $factory) {
        parent::__construct(Core\Constants::LINK, null, Core\Constants::ATOM_NS, $factory);
    }
    
    public function setHref($value) {
        if($value) {
            $this->setAttributeNS(Core\Constants::ATOM_NS, Core\Constants::HREF, $value);
        }
    }
    
    public function getHref() {
        return $this->getAttributeNS(Core\Constants::ATOM_NS, Core\Constants::HREF);
    }
    
    public function setRel($value) {
        if($value) {
            $this->setAttributeNS(Core\Constants::ATOM_NS, Core\Constants::REL, $value);
        }
    }
    
    public function getRel() {
        return $this->getAttributeNS(Core\Constants::ATOM_NS, Core\Constants::REL);
    }
    
    public function setTitle($value) {
        if($value) {
            $this->setAttributeNS(Core\Constants::ATOM_NS, Core\Constants::TITLE, $value);
        }
    }
    
    public function getTitle() {
        return $this->getAttributeNS(Core\Constants::ATOM_NS, Core\Constants::TITLE);
    }
}