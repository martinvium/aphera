<?php
namespace Aphera\Core\Protocol;

abstract class AbstractRequest extends AbstractMessage implements Request
{
    public function getAccept() {
        return $this->getHeader('Accept');
    }
}