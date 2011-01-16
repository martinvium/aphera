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

final class Aphera
{
    private $factory;
    
    private $parser;
    
    private $config;

    private $writer;
    
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
     * @return Writer
     */
    public function getWriter() {
        if(! $this->writer) {
            $this->writer = $this->getFactory()->newWriter();
        }

        return $this->writer;
    }
    
    /**
     * @return Configuration 
     */
    public function getConfiguration() {
        return $this->config;
    }
}