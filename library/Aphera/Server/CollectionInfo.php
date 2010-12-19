<?php
namespace Aphera\Server;

interface CollectionInfo
{
    public function getHref(RequestContext $request);
    
    public function getTitle(RequestContext $request);
    
    public function getAccepts(RequestContext $request);
    
    public function getCategoriesInfo(RequestContext $request);
}