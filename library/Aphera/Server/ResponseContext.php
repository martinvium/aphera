<?php
namespace Aphera\Server;

use Aphera\Core\Protocol\Response;

interface ResponseContext extends Response
{
    public function setStatus($code);
    
    public function setStatusText($message);
    
    public function setContentType($type, $charset = null);
    
    public function hasEntity();
    
    public function setHeader($name, $value);
    
    public function addHeader($name, $value);
}