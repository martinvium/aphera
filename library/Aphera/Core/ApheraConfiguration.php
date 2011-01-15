<?php
/**
 * Copyright 2011 Martin Vium
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
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