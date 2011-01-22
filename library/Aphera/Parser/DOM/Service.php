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
namespace Aphera\Parser\DOM;

use Aphera\Model;
use Aphera\Core\Constants;

class Service extends ExtensibleElement implements Model\Service
{
    protected $workspaces = array();

    public function __construct($factory) {
        parent::__construct(Constants::SERVICE, null, Constants::APP_NS, $factory);
    }

    public function addWorkspace(Model\Workspace $workspace) {
        $this->appendChild($workspace);
    }

    public function getWorkspaces() {
        $this->ownerDocument->registerNodeClass('DOMElement', __NAMESPACE__ . '\\Workspace');
        return $this->getChildrenWithName(Constants::WORKSPACE, Constants::APP_NS);
    }
}