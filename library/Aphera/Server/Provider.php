<?php
namespace Aphera\Server;

use Aphera\Core\Aphera;
use Aphera\Core\Protocol\Resolver;

interface Provider
{
    public function init(Aphera $aphera);
    
    public function getAphera();
    
    /**
     * @return ResponseContext
     */
    public function process(RequestContext $request);

    public function setTargetResolver(Resolver $resolver);

    /**
     * @return Resolver
     */
    public function getTargetResolver();
}