<?php
namespace Aphera\Server;

class AbstractEntityCollectionAdapter extends AbstractCollectionAdapter
{
    public function postEntry(RequestContext $request)
    {
        $id = $this->getResourceName($request);
        $entry = $this->getEntryFromRequest($request);
        $this->postEntryWithCollectionProvider(
                $entry->getTitle(), $id, $summary, $updated, $authors, $content, $request);
    }
    
    protected abstract function postEntryWithCollectionProvider($title, $id, $summary, DateTime $updated, array $authors, $content, RequestContext $request);
    
    public function putEntry(RequestContext $request)
    {
        $entry = $this->getEntryFromRequest($request);
        $this->putEntryWithCollectionProvider($entry, $title, $updated, $authors, $summary, $content, $request);
    }
    
    protected abstract function putEntryWithCollectionProvider($entry, $title, $updated, array $authors, $summary, $content, RequestContext $request);
    
    protected function getEntry($id, RequestContext $request)
    {
        return $this->getEntryFromCollectionProvider($id, $request);
    }
    
    protected abstract function getEntryFromCollectionProvider($id, RequestContext $request);
    
    public abstract function getEntryId($entry);
    
    public abstract function getEntryTitle($entry);
    
    public abstract function getEntryUpdated($entry);
    
    public abstract function getEntryAuthors($entry);
    
    public abstract function getEntryContent($entry);
}