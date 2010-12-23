<?php
namespace Aphera\Server\Context;

use Aphera\Server\ResponseContext;
use Aphera\Core\Protocol\AbstractResponse;
use Aphera\Core\Writer;

abstract class AbstractResponseContext extends AbstractResponse implements ResponseContext
{
    protected $headers = array();
    
    protected $statusCode = 0;
    
    protected $statusText = '';
    
    /**
     * @var Writer
     */
    protected $writer;
    
    public function setAllow($methods) {
        $methods = (array)$methods;
        $allow = \implode(", ", $methods);
        $this->setHeader('Allow', $allow);
    }
    
    public function setContentType($type, $charset = null) {
        $contentType = (string)$type;
        if($charset) {
            $contentType .= ';charset=' . $charset;
        }
        $this->setHeader('Content-Type', $contentType);
    }
    
    public function getStatus() {
        return $this->statusCode;
    }
    
    public function getStatusText() {
        return $this->statusText;
    }
    
    /**
     * @return AbstractResponseContext 
     */
    public function setStatus($code) {
        $this->statusCode = (int)$code;
        return $this;
    }
    
    /**
     * @return AbstractResponseContext 
     */
    public function setStatusText($message) {
        $this->statusText = (string)$message;
        return $this;
    }
    
    public function getHeaders($name = null) {
        $headers = array();
        if($name) {
            if(isset($this->headers[$name])) {
                $headers = $this->headers[$name];
            }
        } else {
            $headers = $this->headers;
        }
        
        return $headers;
    }
    
    public function getHeader($name) {
        $headers = $this->getHeaders($name);
        if(count($headers)) {
            return $headers[0];
        }
        return null;
    }
    
    /**
     * @return AbstractResponseContext 
     */
    public function setHeader($name, $value) {
        $this->headers[$name] = (array)$value;
        return $this;
    }
    
    /**
     * @return AbstractResponseContext 
     */
    public function addHeader($name, $value) {
        if(isset($this->headers[$name])) {
            $this->headers[$name] = array_merge($this->headers[$name], (array)$value);
        } else {
            $this->headers[$name] = (array)$value;
        }
        return $this;
    }
    
    public function setWriter(Writer $writer) {
        $this->writer = $writer;
        return $this;
    }
}