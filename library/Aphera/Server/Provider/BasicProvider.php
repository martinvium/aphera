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

class BasicProvider extends AbstractProvider
{
    protected $workspaceManager;

    public function __construct() {
        parent::__construct();

        $this->routeManager = new RouteManager();
        $this->routeManager->addSimpleRoute('service', '/', Target::TYPE_SERVICE)
                           ->addSimpleRoute('feed', '/:feed/', Target::TYPE_COLLECTION)
                           ->addSimpleRoute('entry', '/:feed/:entry/', Target::TYPE_ENTRY);

        $this->setTargetResolver($this->routeManager);

        $this->workspaceManager = new BasicWorkspaceManager();
    }

    /**
     * @param RequestContext $request
     * @return WorkspaceManager
     */
    public function getWorkspaceManager(RequestContext $request = null) {
        return $this->workspaceManager;
    }

    public function setWorkspaceManager(WorkspaceManager $manager) {
        $this->workspaceManager = $manager;
    }
}