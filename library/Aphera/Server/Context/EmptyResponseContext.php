<?php
namespace Aphera\Server\Context;

use Aphera\Core\Writer;

class EmptyResponseContext extends AbstractResponseContext
{
    public function __construct($code = 0, $message = '') {
        $this->setStatus($code);
        $this->setStatusText($message);
    }
    
    public function hasEntity() {
        return false;
    }

    public function writeTo($stream, Writer $writer = null) {
        
    }
}