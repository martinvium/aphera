<?php
namespace Aphera\Core\Protocol;

interface Response extends Message
{
    const TYPE_SUCCESS = 1;
    const TYPE_REDIRECT = 2;
    const TYPE_CLIENT_ERROR = 3;
    const TYPE_SERVER_ERROR = 4;
    const TYPE_UNKNOWN = 5;
    
    public function getStatus();
    
    public function getStatusText();
    
    public function getAllow();
    
    public function getType();
}