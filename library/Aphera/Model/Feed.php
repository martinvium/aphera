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

interface Feed extends Source
{
    /**
     * @return array of Entry
     */
    public function getEntries();
    
    /**
     * Add entry to the END of the feed
     * 
     * @param Entry $entry if null an empty entry is added
     * @return Entry
     */
    public function addEntry(Entry $entry = null);
    
    /**
     * Add entry to the START of the feed
     * 
     * @param Entry $entry if null an empty entry is added
     * @return Entry
     */
    public function insertEntry(Entry $entry = null);
    
    /**
     * Get the first entry matching the passed id
     * 
     * @return Entry
     */
    public function getEntry($id);
}