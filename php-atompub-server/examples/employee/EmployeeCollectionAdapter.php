<?php
namespace MyTest;

use Aphera\Server;

class EmployeeCollectionAdapter extends Server\AbstractEntityCollectionAdapter
{
    protected $employees = array();
    
    protected function getEntryFromCollectionProvider($id, Server\RequestContext $request)
    {
        return $this->employees[$id];
    }
    
    protected function postEntryWithCollectionProvider($title, $id, $summary, DateTime $updated, array $authors, $content, Server\RequestContext $request)
    {
        $entry = $request->getAphera()->getFactory()->newEntry();
        $this->employees[$id] = $entry;
    }
    
    protected function putEntryWithCollectionProvider($entry, $title, $updated, array $authors, $summary, $content, Server\RequestContext $request)
    {
        $entry->setTitle($title);
        
        $this->employees[$entry->getId()] = $entry;
    }

    public function getAuthor(RequestContext $request)
    {
        return "Acme Industries";
    }

    public function getId(RequestContext $request) {
        return "tag:acme.com,2007:employee:feed";
    }

    public function getTitle(RequestContext $request) {
        return "Acme Employee Database";
    }
    
    public function getEntryId($content);
    
    public function getEntryTitle($content);
    
    public function getUpdated($content);
    
    public function getEntryAuthors($content);
    
    public function getEntryContent($content);
}