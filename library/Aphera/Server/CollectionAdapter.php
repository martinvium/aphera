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
namespace Aphera\Server;

use Aphera\Server\RequestContext;

interface CollectionAdapter
{
    /**
     * Shorthand for referencing the class in configurations etc.
     * 
     * @return string
     */
    public static function getClass();

    /**
     * Returns the Collection's Atom Feed. Called when a GET request is sent to the collection's URI
     * 
     * @return ResponseContext
     */
    public function getFeed(RequestContext $request);
    
    /**
     * Adds a new entry to the Collection. Called when a POST request containing an Atom entry document is sent to the collection's URI
     * 
     * @return ResponseContext
     */
    public function postEntry(RequestContext $request);
    
    /**
     * Retrieves an entry from the Collection. Called when a GET request is sent to the entries edit URI
     * 
     * @return ResponseContext
     */
    public function getEntry(RequestContext $request);
    
    /**
     * Updates an existing entry. Called when a PUT request containing an Atom entry document is sent to the entries edit URI
     * 
     * @return ResponseContext
     */
    public function putEntry(RequestContext $request);
    
    /**
     * Deletes an existing entry. Called when a DELETE request is sent to the entries edit URI
     * 
     * @return ResponseContext
     */
    public function deleteEntry(RequestContext $request);
    
    /**
     * Retrieves options for a given entry. Called when an OPTIONS request is sent to the entries edit URI
     * 
     * @return ResponseContext
     */
    public function optionsEntry(RequestContext $request);
    
    /**
     * Like getEntry, except the entry is not returned. Called when a HEAD request is sent to the entries edit URI
     * 
     * @return ResponseContext
     */
    public function headEntry(RequestContext $request);
}