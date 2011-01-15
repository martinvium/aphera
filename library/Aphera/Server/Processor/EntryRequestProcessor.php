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
namespace Aphera\Server\Processor;

use Aphera\Server\RequestProcessor;
use Aphera\Server\RequestContext;
use Aphera\Server\CollectionAdapter;
use Aphera\Server\WorkspaceManager;

class EntryRequestProcessor implements RequestProcessor
{
    public function process(RequestContext $request, CollectionAdapter $adapter, WorkspaceManager $manager = null) {
        $method = \strtoupper($request->getMethod());
        switch($method) {
            case "GET": return $adapter->getEntry($request); break;
            case "POST": return $adapter->postEntry($request); break;
            case "PUT": return $adapter->putEntry($request); break;
            case "DELETE": return $adapter->deleteEntry($request); break;
            case "HEAD": return $adapter->headEntry($request); break;
            case "OPTIONS": return $adapter->optionsEntry($request); break;
            default: return null;
        }
    }
}