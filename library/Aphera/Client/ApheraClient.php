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

use Aphera\Core;
use Aphera\Core\Aphera;
use Aphera\Core\Parser;

class ApheraClient
{
    /**
     * @var Aphera
     */
    protected $aphera;
    
    /**
     * @var Parser
     */
    protected $parser;
    
    public function __construct(Aphera $aphera) {
        $this->aphera = $aphera;
    }
    
    /**
     * @param string $uri
     * @return ClientResponse
     */
    public function get($uri) {
        return $this->execute("GET", $uri);
    }
    
    /**
     * @param string $uri
     * @param RequestEntity $entity
     * @return ClientResponse
     */
    public function post($uri, RequestEntity $entity) {
        return $this->execute("POST", $uri, $entity);
    }
    
    /**
     * @param string $uri
     * @param RequestEntity $entity
     * @return ClientResponse
     */
    public function put($uri, RequestEntity $entity) {
        return $this->execute("PUT", $uri, $entity);
    }
    
    /**
     * @param string $uri
     * @return ClientResponse
     */
    public function delete($uri) {
        return $this->execute("DELETE", $uri);
    }
    
    /**
     * @param string $uri
     * @return ClientResponse
     */
    public function head($uri) {
        return $this->execute("HEAD", $uri);
    }
    
    /**
     * @param string $uri
     * @return ClientResponse
     */
    public function options($uri) {
        return $this->execute("OPTIONS", $uri);
    }
    
    protected function execute($method, $uri, RequestEntity $entity = null) {
        $ch = \curl_init($uri);
        \curl_setopt($ch, \CURLOPT_CUSTOMREQUEST, $method);
        
        // stream data from curl
        $stream = fopen("php://temp", "r+");
        \curl_setopt($ch, \CURLOPT_FILE, $stream);
        
        \curl_exec($ch);
        
        $response = new CurlResponse($this->aphera, $method, $uri);
        $response->setInputStream($stream);
        return $response;
    }
}