<?php
namespace Aphera\Server\Context;

class DefaultRequestContext extends AbstractRequestContext
{
    public function getTargetType() {
        throw new \Exception('not implemented');
    }
    
    public function getHeader($name)
    {
        return $_SERVER[$name];
    }
    
    public function getHeaders($name)
    {
        return array($_SERVER[$name]);
    }
    
    public function getInputStream()
    {
        return fopen('php://input', 'r');
    }
}