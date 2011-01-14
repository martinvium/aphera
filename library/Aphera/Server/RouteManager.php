<?php
namespace Aphera\Server;

use Aphera\Core\Protocol\Resolver;
use Aphera\Core\Protocol\Request;

class RouteManager implements Resolver
{
    protected $routes = array();

    /**
     * @param RequestContext $request
     * @return RouteTarget
     */
    public function resolve($request) {
        $uri = $request->getTargetPath();
        $route = $this->match($uri);

        if($route) {
            return $this->getTarget($request, $route, $uri);
        }

        return null;
    }

    private function getTarget(RequestContext $request, Route $route, $uri) {
        return new RouteTarget($route->getTargetType(), $request, $route, $uri);
    }
    
    private function get($name) {
        if(isset($this->routes[$name])) {
            return $this->routes[$name];
        }
        return null;
    }
    
    private function match($uri) {
        foreach($this->routes as $route) {
            if($route->match($uri)) {
                return $route;
            }
        }

        return null;
    }

    /**
     * @param string $name
     * @param string $pattern
     * @param string $targetType
     * @return RouteManager
     */
    public function addSimpleRoute($name, $pattern, $targetType) {
        $this->addRoute(new Route($name, $pattern, $targetType));
        return $this;
    }

    /**
     * @param Route $route
     * @return RouteManager
     */
    public function addRoute(Route $route) {
        $this->routes[$route->getName()] = $route;
        return $this;
    }

    /**
     * @todo implement TargetBuilder add this method
     * @see https://github.com/apache/abdera/blob/trunk/server/src/main/java/org/apache/abdera/protocol/server/impl/RouteManager.java
     */
    public function urlFor(RequestContext $request, $name, $object) {
        throw new Exception('not implemented');
        $route = $this->get($name);
        if($route) {
            return $request->getContextPath() . $route->expand($this->getContext($object));
        }
    }

    protected function getContext($object) {
//        return new ObjectRequestContext($object);
    }
}