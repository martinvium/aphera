<?php
namespace Aphera\Server;

interface Provider
{
    public function getAphera();
    
    /**
     * @return ResponseContext
     */
    public function process(RequestContext $request);

    public function setTargetResolver();

    public function getTargetResolver();
}