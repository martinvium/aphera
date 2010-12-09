<?php
namespace Aphera;

interface CollectionAdapter
{
    /**
     * Returns the Collection's Atom Feed. Called when a GET request is sent to the collection's URI
     */
    public function getFeed(RequestContext $request);
    
    /**
     * Adds a new entry to the Collection. Called when a POST request containing an Atom entry document is sent to the collection's URI
     */
    public function postEntry(RequestContext $request);
    
    /**
     * Retrieves an entry from the Collection. Called when a GET request is sent to the entries edit URI
     */
    public function getEntry(RequestContext $request);
    
    /**
     * Updates an existing entry. Called when a PUT request containing an Atom entry document is sent to the entries edit URI
     */
    public function updateEntry(RequestContext $request);
    
    /**
     * Deletes an existing entry. Called when a DELETE request is sent to the entries edit URI
     */
    public function deleteEntry(RequestContext $request);
    
    /**
     * Retrieves options for a given entry. Called when an OPTIONS request is sent to the entries edit URI
     */
    public function optionsEntry(RequestContext $request);
    
    /**
     * Like getEntry, except the entry is not returned. Called when a HEAD request is sent to the entries edit URI
     */
    public function headEntry(RequestContext $request);
    
    /**
     * Returns a Categories document. Called when a GET request is sent to the Category Documents URI as configured by the Provider Target Resolver.
     */
    public function getCategories(RequestContext $request);
    
    /**
     * Called when a request does not match any of the other methods. This allows a CollectionAdapter to flexibly support extensions
     */
    public function extensionRequest(RequestContext $request);
}