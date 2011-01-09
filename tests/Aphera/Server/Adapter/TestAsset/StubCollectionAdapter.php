<?php
namespace Aphera\Server\Adapter\TestAsset;

use Aphera\Server\Adapter\AbstractCollectionAdapter;
use Aphera\Server\RequestContext;

class StubCollectionAdapter extends AbstractCollectionAdapter
{
    public function getId() {
        throw new Exception('not implemented');
    }
    
    public function getAuthor(RequestContext $request) {
        throw new Exception('not implemented');
    }
    
    public function getFeed(RequestContext $request) {
        throw new Exception('not implemented');
    }
    
    public function getTitle(RequestContext $request) {
        throw new Exception('not implemented');
    }
}