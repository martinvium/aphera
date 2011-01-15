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
namespace Aphera\Server;

use Aphera\Core\Protocol\Target;

class RouteTarget implements Target
{
    protected $type;
    protected $request;
    protected $route;
    protected $uri;
    protected $parameters = array();

    public function __construct($targetType, RequestContext $request, Route $route, $uri) {
        $this->type = (int)$targetType;
        $this->request = $request;
        $this->uri = (string)$uri;
        $this->route = $route;
        $this->parameters = (array)$route->parse($uri);
    }

    public function getIdentity() {
        return $this->uri;
    }

    public function getParameter($name) {
        if(isset($this->parameters[$name])) {
            return $this->parameters[$name];
        }
        return null;
    }

    public function getParameters() {
        return $this->parameters;
    }

    public function getType() {
        return $this->type;
    }
}