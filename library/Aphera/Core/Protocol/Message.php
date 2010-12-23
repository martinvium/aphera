<?php
namespace Aphera\Core\Protocol;

interface Message
{
    public function getHeader($name);
    
    public function getHeaders($name);
    
    public function getContentType();
}