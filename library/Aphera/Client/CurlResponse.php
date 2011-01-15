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
namespace Aphera\Client;

use Aphera\Core\Aphera;
use Aphera\Core\Parser;

class CurlResponse implements ClientResponse
{
    /**
     * @var Aphera
     */
    protected $aphera;
    
    /**
     * @var Parser
     */
    protected $parser;
    
    protected $method = '';
    
    protected $uri = '';
    
    protected $in;
    
    public function __construct(Aphera $aphera, $method, $uri) {
        $this->aphera = $aphera;
        $this->parser = $aphera->getParser();
        $this->method = $method;
        $this->uri = $uri;
    }
    
    public function getDocument(Parser $parser = null) {
        if(! $parser) {
            $parser = $this->parser;
        }
        
        return $parser->parseStream($this->in);
    }
    
    public function getMethod() {
        return $this->method;
    }
    
    public function getUri() {
        return $this->uri;
    }
    
    public function setInputStream($stream) {
        $this->in = $stream;
    }
}