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
namespace Aphera\Server\Adapter\TestAsset;

use Aphera\Server\Adapter\AbstractCollectionAdapter;
use Aphera\Server\RequestContext;

class StubCollectionAdapter extends AbstractCollectionAdapter
{
    public function getId(RequestContext $request) {
        throw new \Exception('not implemented');
    }
    
    public function getAuthor(RequestContext $request) {
        throw new \Exception('not implemented');
    }
    
    public function getFeed(RequestContext $request) {
        throw new \Exception('not implemented');
    }
    
    public function getTitle(RequestContext $request) {
        throw new \Exception('not implemented');
    }

    public static function getClass() {
        return __CLASS__;
    }
}