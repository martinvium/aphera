<?php
namespace Aphera\Server;

use Aphera\Core\Protocol\Request;
use Aphera\Core\Parser;

interface RequestContext extends Request
{
    /**
     * @return Aphera\Core\Aphera
     */
    public function getAphera();
    
    public function getMethod();
    
    public function getUri();
    
    public function getResolvedUri();
    
    public function getBaseUri();
    
    public function getDocument(Parser $parser);
    
    public function getInputStream();
    
    public function getTargetType();
}