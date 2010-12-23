<?php
namespace Aphera\Core\TestAsset;

use Aphera\Core;

class StubConfiguration extends Core\ApheraConfiguration
{
    private $environmentVariables = array();
    
    protected function getEnvironmentVariable($id) {
        if(isset($this->environmentVariables[$id])) {
            return $this->environmentVariables[$id];
        } else {
            return null;
        }
    }
    
    public function setTestEnvirmentVariable($id, $value) {
        $this->environmentVariables[$id] = $value;
    }
}