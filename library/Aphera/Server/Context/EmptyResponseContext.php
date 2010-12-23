<?php
namespace Aphera\Server\Context;

use Aphera\Core\Writer;

class EmptyResponseContext extends AbstractResponseContext
{
    public function hasEntity() {
        return false;
    }

    public function writeTo($stream, Writer $writer = null) {
        
    }
}