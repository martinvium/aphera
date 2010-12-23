<?php
namespace Aphera\Server\Context;

class EmptyResponseContext extends AbstractResponseContext
{
    public function hasEntity() {
        return false;
    }
}