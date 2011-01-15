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
namespace Aphera\Model;

use Aphera\Model;

interface Content extends ExtensibleElement
{
    public function getContentType();
    
    public function setContentType($type);
    
    public function getSrc();
    
    public function getResolvedSrc();
    
    public function setSrc($src);
    
    public function setValue($value);
    
    public function getValueElement();
    
    public function setValueElement(Model\Element $element);
}