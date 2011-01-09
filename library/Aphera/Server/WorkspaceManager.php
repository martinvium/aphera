<?php
namespace Aphera\Server;

interface WorkspaceManager
{
    public function getCollectionAdapter(RequestContext $request);
}