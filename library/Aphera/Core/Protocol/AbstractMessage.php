<?php
namespace Aphera\Core\Protocol;

abstract class AbstractMessage implements Message
{
    public function getContentType() {
        return $this->getHeader('Content-Type');
    }
}