<?php
/**
 * Copyright 2011 Martin Vium
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
namespace Aphera\Server\Provider;

use Aphera\Server\Provider;
use Aphera\Server\RequestContext;
use Aphera\Server\RequestProcessor;
use Aphera\Server\ResponseContext;
use Aphera\Server\WorkspaceManager;
use Aphera\Server\Processor\CollectionRequestProcessor;
use Aphera\Server\Processor\EntryRequestProcessor;
use Aphera\Server\ProviderHelper;

use Aphera\Core\Aphera;
use Aphera\Core\Protocol\Target;
use Aphera\Core\Protocol\Resolver;

abstract class AbstractProvider implements Provider
{
    /**
     * @var Aphera
     */
    protected $aphera;

    /**
     * @var array of RequestProcessor
     */
    protected $processors = array();

    /**
     * @var Resolver
     */
    protected $targetResolver;

    /**
     * @todo implement other target types
     */
    public function __construct() {
        $this->processors[Target::TYPE_COLLECTION] = new CollectionRequestProcessor();
        $this->processors[Target::TYPE_ENTRY]      = new EntryRequestProcessor();
    }

    public function init(Aphera $aphera) {
        $this->aphera = $aphera;
    }

    /**
     * @param RequestContext $request
     * @return ResponseContext
     */
    public function process(RequestContext $request) {
        $type = $request->getTarget()->getType();
        if(! $type) {
            return ProviderHelper::notFound($request);
        }
        
        if(! isset($this->processors[$type])) {
            return ProviderHelper::notFound($request);
        }
        
        $processor = $this->processors[$type];
        $workspaceManager = $this->getWorkspaceManager($request);
        $adapter = $workspaceManager->getCollectionAdapter($request);
        
        $response = $processor->process($request, $adapter, $workspaceManager);
        if(! $response) {
            return ProviderHelper::notFound($request);
        }
        
        return $response;
    }

    /**
     * @param RequestContext $request
     * @return WorkspaceManager
     */
    protected abstract function getWorkspaceManager(RequestContext $request);

    public function getAphera() {
        return $this->aphera;
    }

    /**
     * @return Resolver
     */
    public function getTargetResolver() {
        return $this->targetResolver;
    }

    public function setTargetResolver(Resolver $resolver) {
        $this->targetResolver = $resolver;
    }
}