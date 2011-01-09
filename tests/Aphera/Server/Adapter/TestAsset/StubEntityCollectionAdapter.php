<?php
namespace Aphera\Server\Adapter\TestAsset;

use Aphera\Model\ExtensibleElement;
use Aphera\Server\RequestContext;
use Aphera\Server\Adapter\AbstractEntityCollectionAdapter;


class StubEntityCollectionAdapter extends AbstractEntityCollectionAdapter
{
    public $testEntryByResourceName;
    
    public function getId() {
        throw new Exception('not implemented');
    }
    
    public function getAuthor() {
        throw new Exception('not implemented');
    }
    
    protected function getEntryByResourceName($name) {
        return $this->testEntryByResourceName;
    }

    protected function postEntryWithCollectionProvider($title, $id, $summary, \DateTime $updated, array $authors, $content, RequestContext $request)
    {
        
    }

    protected function putEntryWithCollectionProvider($entry, $title, $updated, array $authors, $summary, $content, RequestContext $request)
    {
        
    }

    public function getEntryAuthors(ExtensibleElement $entry)
    {
        
    }

    public function getEntryContent(ExtensibleElement $entry)
    {
        
    }

    public function getEntryId(ExtensibleElement $entry)
    {
        
    }

    public function getEntryTitle(ExtensibleElement $entry)
    {
        
    }

    public function getEntryUpdated(ExtensibleElement $entry)
    {
        
    }

    public function getFeed(RequestContext $request)
    {
        
    }

    public function getTitle(RequestContext $request)
    {
        
    }
}