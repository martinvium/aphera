<?php
namespace Aphera\Server\Context;

use Aphera\Server\Provider;

class DefaultRequestContext extends StreamRequestContext
{
    public function __construct(Provider $provider, $method, $uri, $baseUri) {
        parent::__construct(\fopen('php://input', 'r'), $provider, $method, $uri, $baseUri);
    }
}