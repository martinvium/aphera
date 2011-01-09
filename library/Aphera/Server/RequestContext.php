<?php
namespace Aphera\Server;

use Aphera\Core\Protocol\Request;
use Aphera\Core\Parser;
use Aphera\Core\Protocol\Target;
use Aphera\Core\Aphera;

interface RequestContext extends Request
{
    /**
     * @return Aphera
     */
    public function getAphera();
    
    public function getMethod();
    
    public function getUri();
    
    public function getResolvedUri();
    
    public function getBaseUri();
    
    public function getDocument(Parser $parser);
    
    public function getInputStream();
    
    public function getTargetType();
    
    /**
     * @return Target
     */
    public function getTarget();

    public function getContextPath();

    public function getTargetPath();
}