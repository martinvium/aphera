<?php
namespace Aphera\Server;

interface ResponseContext
{
    public function setStatus($code);
    
    public function setStatusText($message);
}