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

class Feed extends Source implements Model\Feed
{
    const ENTRY_CLASS = "\\Aphera\\Parser\\DOM\\Entry";
    
    public function __construct(Core\Factory $factory = null) {
        parent::__construct(Core\Constants::FEED, $factory);
    }
    
    /**
     * @return array of Model\Entry
     */
    public function getEntries() {
        $this->ownerDocument->registerNodeClass('DOMElement', self::ENTRY_CLASS);
        return $this->getChildrenWithName(Core\Constants::ENTRY);
    }
    
    /**
     * @param Model\Entry $entry passing an entry will return an imported COPY
     * @return Model\Entry
     */
    public function addEntry(Model\Entry $entry = null) {
        if($entry) {
            $this->ownerDocument->registerNodeClass('DOMElement', self::ENTRY_CLASS);
            $entry = $this->ownerDocument->importNode($entry, true);
        } else {
            $entry = $this->factory->newEntry($this);
        }
        
        $this->appendChild($entry);
        
        return $entry;
    }
    
    public function insertEntry(Model\Entry $entry = null) {
        throw new \Exception('not implemented');
    }
    
    /**
     * @param string $id
     * @return Model\Entry
     */
    public function getEntry($id) {
        return Helper::getFirstElementWithChildElementValue($this->getEntries(), Core\Constants::ID, $id, Core\Constants::ATOM_NS);
    }
}