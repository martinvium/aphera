<?php
namespace Aphera\Core\Protocol;

interface Target
{
    const TYPE_UNKOWN     = 1;
    const TYPE_NOT_FOUND  = 2;
    const TYPE_SERVICE    = 3;
    const TYPE_COLLECTION = 4;
    const TYPE_ENTRY      = 5;
    const TYPE_MEDIA      = 6;
    const TYPE_CATEGORIES = 7;

    public function getIdentity();
    
    public function getType();

    public function getParameter($name);

    public function getParameters();
}
