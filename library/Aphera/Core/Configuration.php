<?php
namespace Aphera\Core;

interface Configuration
{
    public function newFactoryInstance(Aphera $aphera);
    
    public function newParserInstance(Aphera $aphera);
    
    public function getConfigurationOption($id, $default = null);
    
    public function addExtensionFactory(ExtensionFactory $factory);
    
    public function getExtensionFactories();
}