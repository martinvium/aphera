<?php
namespace Aphera\Server;

abstract class AbstractCollectionAdapter implements MediaCollectionAdapter, 
        Transactional, CollectionInfo
{
    private $href = '';
    
    public abstract function getId(RequestContext $request);
    
    public abstract function getAuthor(RequestContext $request);
    
    public abstract function getTitle(RequestContext $request);
    
    public function getHref()
    {
        return $this->href;
    }
    
    public function setHref($href)
    {
        $this->href = (string)$href;
    }
    
    public function start(RequestContext $request)
    {
        
    }
    
    public function end(RequestContext $request)
    {
        
    }
    
    public function compensate(RequestContext $request)
    {
        
    }
    
    public function postEntry(RequestContext $request)
    {
        return ProviderHelper::notAllowedMethod($request);
    }
    
    public function getEntry(RequestContext $request)
    {
        return ProviderHelper::notAllowedMethod($request);
    }
    
    public function updateEntry(RequestContext $request)
    {
        return ProviderHelper::notAllowedMethod($request);
    }
    
    public function deleteEntry(RequestContext $request)
    {
        return ProviderHelper::notAllowedMethod($request);
    }
    
    public function optionsEntry(RequestContext $request)
    {
        return ProviderHelper::notAllowedMethod($request);
    }
    
    public function headEntry(RequestContext $request)
    {
        return ProviderHelper::notAllowedMethod($request);
    }
    
    public function getCategories(RequestContext $request)
    {
        return array();
    }
    
    /**
     * @param RequestContext $request 
     */
    protected function getEntryFromRequest(RequestContext $request)
    {
        // initialize parser
        // get entry from request body
        // return entry
    }
    
    /**
     * Get's the name of the specific resource requested
     * 
     * @param RequestContext $request 
     */
    protected function getResourceName(RequestContext $request)
    {
        // picks out the last part of the target path??
        // https://github.com/apache/abdera/blob/trunk/server/src/main/java/org/apache/abdera/protocol/server/impl/AbstractCollectionAdapter.java
    }
}