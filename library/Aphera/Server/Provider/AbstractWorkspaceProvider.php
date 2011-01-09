<?php
namespace Aphera\Server\Provider;

use Aphera\Server\WorkspaceManager;

abstract class AbstractWorkspaceProvider extends AbstractProvider implements WorkspaceManager
{
    protected function getWorkspaceManager(RequestContext $request) {
        return $this;
    }
}