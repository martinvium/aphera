<?php
namespace Aphera\Server\Provider;

use Aphera\Server\RequestContext;
use Aphera\Server\RouteManager;
use Aphera\Server\CollectionAdapter;
use Aphera\Server\WorkspaceManager;

use Aphera\Core\Protocol\Target;
use Aphera\Core\Protocol\Resolver;

class BasicWorkspaceManager implements WorkspaceManager
{
    protected $adapterMap = array();
    protected $registeredAdapterClasses = array();

    /**
     * @todo maybe we should just return null, instead of throwing an exception?
     * @param RequestContext $request
     * @return CollectionAdapter
     */
    public function getCollectionAdapter(RequestContext $request) {
        $feedId = $request->getTarget()->getParameter('feed');

        if(isset($this->adapterMap[$feedId])) {
            return $this->adapterMap[$feedId];
        }

        if(! isset($this->registeredAdapterClasses[$feedId])) {
            throw new \InvalidArgumentException('no adapter registered with id: ' . var_export($feedId, true));
        }

        $className = $this->registeredAdapterClasses[$feedId];
        $adapter = new $className($this->aphera);
        $this->adapterMap[$feedId] = $adapter;
        return $adapter;
    }

    public function registerCollectionAdapter($feedId, $className) {
        $this->registeredAdapterClasses[$feedId] = $className;
    }
}