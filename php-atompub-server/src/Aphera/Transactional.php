<?php
namespace Aphera;

interface Transactional
{
    /**
     * Called before invoking the CollectionAdapter or MediaCollectionAdapter methods.
     */
    public function start(RequestContext $request);
    
    /**
     * Called after invoking the CollectionAdapter or MediaCollectionAdapter methods.
     */
    public function end(RequestContext $request);
    
    /**
     * Called when an error occurs during the processing of the CollectionAdapter or MediaCollectionAdapter methods.
     */
    public function compensate(RequestContext $request);
}