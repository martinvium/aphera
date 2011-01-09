<?php
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