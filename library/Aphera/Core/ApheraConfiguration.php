<?php
namespace Aphera\Core;

class ApheraConfiguration implements Configuration
{
    protected $extensionFactories = array();
    
    public static function getDefault() {
        return new ApheraConfiguration();
    }

    public function addExtensionFactory(ExtensionFactory $factory) {
        $this->extensionFactories[] = $factory;
    }

    public function getConfigurationOption($id, $default = null) {
        $value = $this->getEnvironmentVariable($id);
        if($default !== null) {
            $value = ($value ? $value : $default);
        }
        
        return $value;
    }
    
    protected function getEnvironmentVariable($id) {
        return \getenv($id);
    }

    public function getExtensionFactories() {
        return $this->extensionFactories;
    }

    public function newFactoryInstance(Aphera $aphera) {
        $class = $this->getConfigurationOption(Constants::CONFIG_FACTORY, Constants::DEFAULT_FACTORY);
        return new $class($aphera);
    }

    public function newParserInstance(Aphera $aphera) {
        $class = $this->getConfigurationOption(Constants::CONFIG_PARSER, Constants::DEFAULT_PARSER);
        return new $class($aphera);
    }
}