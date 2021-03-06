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

interface Entry extends ExtensibleElement
{
    public function getContentElement();
    
    public function getContent();
    
    public function setContent($content);
    
    public function getIdElement();
    
    public function getId();
    
    public function setId($id);
    
    public function newId();
    
    public function getLinks($rel = null);
    
    public function addLink($href, $rel = null, $title = null);
    
    public function getSummaryElement();
    
    public function getSummary();
    
    public function setSummary($value);
    
    public function getTitleElement();
    
    public function getTitle();
    
    public function setTitle($value);

    public function getUpdated();

    public function setUpdated(\DateTime $datetime);
}