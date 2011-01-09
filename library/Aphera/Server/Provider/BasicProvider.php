<?php
namespace Aphera\Server\Provider;

use Aphera\Server\RequestContext;
use Aphera\Server\RouteManager;
use Aphera\Core\Protocol\Target;
use Aphera\Server\CollectionAdapter;

class BasicProvider extends AbstractWorkspaceProvider
{
    protected $adapterMap = array();
    protected $registeredAdapterClasses = array();

    public function __construct() {
        parent::__construct();
        $this->init();
    }

    public function registerCollectionAdapter($feedId, $className) {
        $this->registeredAdapterClasses[$feedId] = $className;
    }

    private function init() {
        $this->routeManager = new RouteManager();
        $this->routeManager->addSimpleRoute('service', '/', Target::TYPE_SERVICE)
                           ->addSimpleRoute('feed', '/:feed/', Target::TYPE_COLLECTION)
                           ->addSimpleRoute('entry', '/:feed/:entry/', Target::TYPE_ENTRY);

        $this->setTargetResolver($this);
    }

    /**
     *
     * @param RequestContext $request
     * @return CollectionAdapter
     */
    public function getCollectionAdapter(RequestContext $request) {
        $feedId = $request->getTarget()->getParameter('feed');

        if(isset($this->adapterMap[$feedId])) {
            return $this->adapterMap[$feedId];
        }

        if(! isset($this->registeredAdapterClasses[$feedId])) {
            throw new InvalidArgumentException('no adapter registered with id: ' . $feedId);
        }

        $className = $this->registeredAdapterClasses[$feedId];
        $adapter = new $className($this->aphera);
        return $adapter;
    }
}