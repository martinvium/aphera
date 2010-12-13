<?php
namespace Aphera\Core;

class ApheraConfiguration implements Configuration
{
    protected $extensionFactories = array();
    
    
    public static function getDefault()
    {
        return new ApheraConfiguration();
    }

    public function addExtensionFactory(ExtensionFactory $factory)
    {
        $this->extensionFactories[] = $factory;
    }

    public function getConfigurationOption($id, $default = null)
    {
        $value = \getenv($id);
        if($default !== null) {
            $value = ($value ? $value : $default);
        }
        
        return $value;
    }

    public function getExtensionFactories()
    {
        return $this->extensionFactories;
    }

    public function newFactoryInstance(Aphera $aphera)
    {
        $class = Constants::CONFIG_FACTORY;
        return $this->load($class, Constants::DEFAULT_FACTORY);
    }

    public function newParserInstance(Aphera $aphera)
    {
        $class = Constants::CONFIG_PARSER;
        return $this->load($class, Constants::DEFAULT_PARSER);
    }
    
    private function load($class, $defaultClass)
    {
        $do_autoload = true;
        if(\class_exists($class, $do_autoload)) {
            return new $class;
        } else {
            return new $defaultClass;
        }
    }
}