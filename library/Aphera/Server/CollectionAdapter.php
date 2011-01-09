<?php
namespace Aphera\Server;

use Aphera\Server\RequestContext;

interface CollectionAdapter
{
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