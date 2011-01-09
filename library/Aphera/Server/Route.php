<?php
namespace Aphera\Server;

class Route
{
    protected $name;
    protected $pattern;
    protected $targetType;

    public function __construct($name, $pattern, $targetType) {
        $this->name = (string)$name;
        $this->pattern = (string)$pattern;
        $this->targetType = (int)$targetType;
    }

    public function getName() {
        return $this->name;
    }
    
    public function getPattern() {
        return $this->pattern;
    }

    public function getTargetType() {
        return $this->targetType;
    }

    /**
     * @todo parse parameters (via get target?) in context and build an url
     * @param RequestContext $request
     */
    public function expand(RequestContext $request) {
        throw new Exception('not implemented');
    }

    /**
     * @todo return true if route matches uri
     * @param string $uri
     * @return boolean
     */
    public function match($uri) {
        if(count($this->split($uri)) == count($this->split($this->pattern))) {
            return true;
        }

        return false;
    }

    /**
     * @param string $uri
     * @return array of parameters
     */
    public function parse($uri) {
        $parameters = array();
        $uriParts = $this->split($uri);

        $patternParts = $this->split($this->pattern);
        foreach($patternParts as $key => $patternPart) {
            $paramName = ltrim($patternPart, ':');
            if(isset($uriParts[$key])) {
                $parameters[$paramName] = $uriParts[$key];
            } else {
                $parameters[$paramName] = null;
            }
        }

        return $parameters;
    }

    private function split($uri) {
        $path = parse_url($uri, PHP_URL_PATH);
        $path = trim($path, '/');
        $parts = explode("/", $path);
        $parts = array_filter($parts, array($this, 'notEmpty'));
        return $parts;
    }

    private function notEmpty($str) {
        return ! empty($str);
    }
}