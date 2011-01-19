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

use Aphera\Server\WorkspaceInfo;
use Aphera\Server\RequestContext;
use Aphera\Server\CollectionInfo;

use Aphera\Model\ExtensibleElement;

class BasicWorkspace implements WorkspaceInfo
{
    private $title = '';

    private $collections = array();

    public function addCollection(CollectionInfo $collection) {
        $this->collections[] = $collection;
    }

    public function getTitle(RequestContext $request) {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = (string)$title;
    }

    /**
     * @see https://github.com/apache/abdera/blob/trunk/server/src/main/java/org/apache/abdera/protocol/server/impl/SimpleWorkspaceInfo.java
     * @param RequestContext $request
     * @return Workspace
     */
    public function asWorkspaceElement(RequestContext $request, ExtensibleElement $parent) {
        $workspace = $request->getAphera()->getFactory()->newWorkspace($parent);
        $workspace->setTitle($this->title);
        
        foreach($this->collections as $collection) {
            $collection->asCollectionElement($request, $workspace);
        }
        
        return $workspace;
    }

    public function getCollections(RequestContext $request) {
        return $this->collections;
    }
}