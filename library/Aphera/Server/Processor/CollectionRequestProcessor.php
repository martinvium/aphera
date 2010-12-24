<?php
namespace Aphera\Server\Processor;

use Aphera\Server\RequestProcessor;
use Aphera\Server\RequestContext;
use Aphera\Server\CollectionAdapter;
use Aphera\Server\WorkspaceManager;

class CollectionRequestProcessor implements RequestProcessor
{
    public function process(RequestContext $request, CollectionAdapter $adapter, WorkspaceManager $manager = null) {
        $method = \strtoupper($request->getMethod());
        switch($method) {
            case "GET": return $adapter->getFeed($request); break;
            case "POST": return $adapter->postEntry($request); break;
            default: return null;
        }
    }
}