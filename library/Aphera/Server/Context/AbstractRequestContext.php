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

use Aphera\Server\RequestContext;
use Aphera\Server\Provider;
use Aphera\Server\Route;

use Aphera\Model\Document;

use Aphera\Core\Parser;
use Aphera\Core\Protocol\AbstractRequest;
use Aphera\Core\Protocol\Resolver;

abstract class AbstractRequestContext extends AbstractRequest implements RequestContext
{
    /**
     * @var Provider
     */
    protected $provider;
    
    protected $method = '';
    
    protected $uri = '';
    
    protected $baseUri = '';

    /**
     * @var Resolver
     */
    protected $targetResolver;
    
    public function __construct(Provider $provider, $method, $uri, $baseUri) {
        $this->provider = $provider;
        $this->method = (string)$method;
        $this->uri = (string)$uri;
        $this->baseUri = (string)$baseUri;
    }

    public function getProvider() {
        return $this->provider;
    }

    /**
     * @todo cache resolving?
     * @return Route
     */
    public function getTarget() {
        return $this->provider->getTargetResolver()->resolve($this);
    }
    
    public function getAphera() {
        return $this->provider->getAphera();
    }
    
    /**
     * @param Parser $parser
     * @return Document
     */
    public function getDocument(Parser $parser) {
        return $parser->parseStream($this->getInputStream());
    }
    
    public function getMethod() {
        return $this->method;
    }
    
    public function getResolvedUri() {
        throw new \Exception('not implemented');
    }
    
    public function getUri() {
        return $this->uri;
    }
    
    public function getBaseUri() {
        return $this->baseUri;
    }

    public function getTargetPath() {
        $path = $this->getContextPath();
        return substr($this->getUri(), \strlen($path));
    }
}