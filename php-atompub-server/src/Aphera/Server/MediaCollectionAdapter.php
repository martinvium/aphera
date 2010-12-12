<?php
namespace Aphera\Server;

interface MediaCollectionAdapter extends CollectionAdapter
{
    /**
     * Adds a new entry to the Collection. Called when a POST request containing a media resource is sent to the collection's URI
     */
    public function postMedia(RequestContext $request);
    
    /**
     * Retrieves an entry from the Collection. Called when a GET request is sent to the edit-media URI
     */
    public function getMedia(RequestContext $request);
    
    /**
     * Updates an existing entry. Called when a PUT request containing a media resource is sent to the edit-media URI
     */
    public function updateMedia(RequestContext $request);
    
    /**
     * Deletes an existing entry. Called when a DELETE request is sent to the edit-media URI
     */
    public function deleteMedia(RequestContext $request);
    
    /**
     * Retrieves options for a given entry. Called when an OPTIONS request is sent to the edit-media URI
     */
    public function optionsMedia(RequestContext $request);
    
    /**
     * Like getEntry, except the entry is not returned. Called when a HEAD request is sent to the edit-media URI
     */
    public function headMedia(RequestContext $request);
}