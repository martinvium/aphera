<?php
namespace Aphera\Core;

final class Aphera
{
    private $factory;
    
    private $config;
    
    public function __construct(Configuration $config = null)
    {
        if(! $config) {
            $config = ApheraConfiguration::getDefaultConfiguration();
        }
        
        $this->config = $config;
    }
    
    public function getFactory()
    {
        if(! $this->factory) {
            $this->factory = $this->newFactory();
        }
        
        return $this->factory;
    }
    
    protected function newFactory()
    {
        $this->config->newFactoryInstance($this);
    }
    
    public function getConfiguration()
    {
        return $this->config;
    }
}