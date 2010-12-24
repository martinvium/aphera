<?php
namespace Aphera\Server\Context;

use Aphera\Core\Protocol\AbstractRequest;
use Aphera\Core\Parser;
use Aphera\Model\Document;
use Aphera\Server\RequestContext;
use Aphera\Server\Provider;

abstract class AbstractRequestContext extends AbstractRequest implements RequestContext
{
    /**
     * @var Provider
     */
    protected $provider;
    
    protected $method = '';
    
    protected $uri = '';
    
    protected $baseUri = '';
    
    public function __construct(Provider $provider, $method, $uri, $baseUri) {
        $this->provider = $provider;
        $this->method = (string)$method;
        $this->uri = (string)$uri;
        $this->baseUri = (string)$baseUri;
    }
    
    public function getAphera() {
        $this->provider->getAphera();
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
}