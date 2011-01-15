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

class Element extends \DOMElement implements Model\Element
{
    /**
     * @var \DOMDocument
     */
    protected $ownerDocument;
    
    public function __construct ($name, $value, $uri) {
        parent::__construct($name, $value, $uri);
    }
    
    public function getTagName() {
        return $this->tagName;
    }
    
    public function getValue() {
        return $this->nodeValue;
    }

    /**
     * @return Core\Factory
     */
    public function getFactory() {
        return $this->factory;
    }

    public function writeTo(Core\Writer $out) {
        throw new Exception('not implemented');
    }
}