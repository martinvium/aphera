<?php
namespace Aphera\Server;

use Aphera\Core\Protocol\Target;

class RouteTarget implements Target
{
    protected $type;
    protected $request;
    protected $route;
    protected $uri;
    protected $parameters = array();

    public function __construct($targetType, RequestContext $request, Route $route, $uri) {
        $this->type = (int)$targetType;
        $this->request = $request;
        $this->uri = (string)$uri;
        $this->route = $route;
        $this->parameters = (array)$route->parse($uri);
    }

    public function getIdentity() {
        return $this->uri;
    }

    public function getParameter($name) {
        return $this->parameters[$name];
    }

    public function getParameters() {
        return $this->parameters;
    }

    public function getType() {
        return $this->type;
    }
}