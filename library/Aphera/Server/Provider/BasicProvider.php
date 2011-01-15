<?php
namespace Aphera\Server\Provider;

use Aphera\Server\RequestContext;
use Aphera\Server\RouteManager;
use Aphera\Server\CollectionAdapter;
use Aphera\Server\WorkspaceManager;

use Aphera\Core\Protocol\Target;
use Aphera\Core\Protocol\Resolver;

class BasicProvider extends AbstractProvider
{
    protected $workspaceManager;

    public function __construct($base = '/') {
        parent::__construct();

        $this->routeManager = new RouteManager();
        $this->routeManager->addSimpleRoute('service', $base, Target::TYPE_SERVICE)
                           ->addSimpleRoute('feed', $base . ':feed/', Target::TYPE_COLLECTION)
                           ->addSimpleRoute('entry', $base . ':feed/:entry/', Target::TYPE_ENTRY);

        $this->setTargetResolver($this->routeManager);

        $this->workspaceManager = new BasicWorkspaceManager();
    }

    public function getWorkspaceManager(RequestContext $request = null) {
        return $this->workspaceManager;
    }

    public function setWorkspaceManager(WorkspaceManager $manager) {
        $this->workspaceManager = $manager;
    }
}