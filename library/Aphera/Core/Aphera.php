<?php
namespace Aphera\Core;

final class Aphera
{
    private $factory;
    
    private $parser;
    
    private $config;
    
    public function __construct(Configuration $config = null) {
        if(! $config) {
            $config = ApheraConfiguration::getDefault();
        }
        
        $this->config = $config;
    }
    
    /**
     * @return Factory
     */
    public function getFactory() {
        if(! $this->factory) {
            $this->factory = $this->newFactory();
        }
        
        return $this->factory;
    }
    
    /**
     * @return Factory
     */
    protected function newFactory() {
        return $this->config->newFactoryInstance($this);
    }
    
    /**
     * @return Parser
     */
    public function getParser() {
        if(! $this->parser) {
            $this->parser = $this->getFactory()->newParser();
        }
        
        return $this->parser;
    }
    
    /**
     * @return Configuration 
     */
    public function getConfiguration() {
        return $this->config;
    }
}