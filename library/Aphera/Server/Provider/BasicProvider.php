<?php
namespace Aphera\Server\Provider;

use Aphera\Server\RequestContext;
use Aphera\Server\RouteManager;
use Aphera\Server\CollectionAdapter;

use Aphera\Core\Protocol\Target;
use Aphera\Core\Protocol\Resolver;

class BasicProvider extends AbstractWorkspaceProvider
{
    protected $adapterMap = array();
    protected $registeredAdapterClasses = array();

    public function __construct($base = '/') {
        parent::__construct();

        $this->routeManager = new RouteManager();
        $this->routeManager->addSimpleRoute('service', $base, Target::TYPE_SERVICE)
                           ->addSimpleRoute('feed', $base . ':feed/', Target::TYPE_COLLECTION)
                           ->addSimpleRoute('entry', $base . ':feed/:entry/', Target::TYPE_ENTRY);

        $this->setTargetResolver($this->routeManager);
    }

    public function registerCollectionAdapter($feedId, $className) {
        $this->registeredAdapterClasses[$feedId] = $className;
    }

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
        return $adapter;
    }
}