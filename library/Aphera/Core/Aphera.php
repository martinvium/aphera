<?php
namespace Aphera\Core;

final class Aphera
{
    private $factory;
    
    private $config;
    
    public function __construct(Configuration $config = null) {
        if(! $config) {
            $config = ApheraConfiguration::getDefault();
        }
        
        $this->config = $config;
    }
    
    /**
     * @return Core\Factory
     */
    public function getFactory() {
        if(! $this->factory) {
            $this->factory = $this->newFactory();
        }
        
        return $this->factory;
    }
    
    /**
     * @return Core\Factory
     */
    protected function newFactory() {
        return $this->config->newFactoryInstance($this);
    }
    
    /**
     * @return Core\Configuration 
     */
    public function getConfiguration() {
        return $this->config;
    }
}