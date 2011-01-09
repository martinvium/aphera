<?php
namespace Aphera\Server\Provider;

use Aphera\Server\Target;
use Aphera\Server\Processor\CollectionRequestProcessor;
use Aphera\Server\Processor\EntryRequestProcessor;

abstract class AbstractProvider implements Provider
{
    protected $aphera;
    
    protected $processors = array();

    /**
     * @todo implement other target types
     */
    public function __construct() {
        $this->processors[Target::TYPE_COLLECTION] = new CollectionRequestProcessor();
        $this->processors[Target::TYPE_ENTRY]      = new EntryRequestProcessor();
    }
    
    public function process(RequestContext $request) {
        $type = $request->getTargetType();
        if(! $type) {
            return ProviderHelper::notFound($request);
        }
        
        if(! isset($this->processors[$type])) {
            return ProviderHelper::notFound($request);
        }
        
        $processor = $this->processors[$type];
        $workspaceManager = $this->getWorkspaceManager($request);
        $adapter = $workspaceManager->getCollectionAdapter($request);
        
        $response = $processor->process($request, $workspaceManager, $adapter);
        if(! $response) {
            return ProviderHelper::notFound($request);
        }
        
        return $response;
    }
    
    protected abstract function getWorkspaceManager(RequestContext $request);

    public function getAphera() {
        return $this->aphera;
    }
}