<?php
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