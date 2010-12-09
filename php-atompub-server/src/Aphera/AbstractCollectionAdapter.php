<?php
namespace Aphera;

abstract class AbstractCollectionAdapter implements CollectionAdapter, MediaCollectionAdapter, 
        Transactional, CollectionInfo
{
    private $href = '';
    
    public function getHref()
    {
        return $this->href;
    }
}