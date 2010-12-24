<?php
namespace Aphera\Server\Context\TestAsset;

use Aphera\Server\Context\DefaultRequestContext;

class StubRequestContext extends DefaultRequestContext
{
    protected $stream;
    
    public function getInputStream() {
        return $this->stream;
    }
    
    public function setTestStream($stream) {
        $this->stream = $stream;
    }
}