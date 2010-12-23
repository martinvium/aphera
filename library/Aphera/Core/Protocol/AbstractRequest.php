<?php
namespace Aphera\Core\Protocol;

abstract class AbstractRequest extends AbstractMessage implements Response
{
    public function getAccept() {
        return $this->getHeader('Accept');
    }
}