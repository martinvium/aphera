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