<?php
namespace Aphera\Server\Processor;

use Aphera\Server\RequestProcessor;
use Aphera\Server\RequestContext;
use Aphera\Server\CollectionAdapter;
use Aphera\Server\WorkspaceManager;

class EntryRequestProcessor implements RequestProcessor
{
    public function process(RequestContext $request, CollectionAdapter $adapter, WorkspaceManager $manager = null) {
        $method = \strtoupper($request->getMethod());
        switch($method) {
            case "GET": return $adapter->getEntry($request); break;
            case "POST": return $adapter->postEntry($request); break;
            case "PUT": return $adapter->putEntry($request); break;
            case "DELETE": return $adapter->deleteEntry($request); break;
            case "HEAD": return $adapter->headEntry($request); break;
            case "OPTIONS": return $adapter->optionsEntry($request); break;
            default: return null;
        }
    }
}