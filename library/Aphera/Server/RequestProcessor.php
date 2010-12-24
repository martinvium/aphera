<?php
namespace Aphera\Server;

interface RequestProcessor
{
    /**
     * @return ResponseContext
     */
    public function process(RequestContext $request, 
                            CollectionAdapter $adapter,
                            WorkspaceManager $manager = null);
}