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
namespace Aphera\Server\Context;

use Aphera\Server\Provider;

class StreamRequestContext extends AbstractRequestContext
{
    private $stream;
    
    public function __construct($stream, Provider $provider, $method, $uri, $baseUri) {
        parent::__construct($provider, $method, $uri, $baseUri);
        $this->stream = $stream;
    }
    
    public function getHeader($name) {
        return $_SERVER[$name];
    }
    
    public function getHeaders($name) {
        return array($_SERVER[$name]);
    }
    
    public function getInputStream() {
        return $this->stream;
    }

    /**
     * @return string
     */
    public function getContextPath() {
        return $this->baseUri;
    }
}