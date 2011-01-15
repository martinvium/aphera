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

require_once(dirname(dirname(dirname(__FILE__))) . '/bootstrap.php');

class ApheraConfigurationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Aphera
     */
    protected $aphera;
    
    /**
     * @var TestAsset\StubConfiguration
     */
    protected $config;

    protected function setUp() {
        parent::setUp();
        $this->aphera = new Aphera();
        $this->config = new TestAsset\StubConfiguration();
    }
    
    public function testGetDefault_Scenario_ReturnsApheraConfiguration() {
        $config = ApheraConfiguration::getDefault();
        $this->assertType(__NAMESPACE__ . '\\ApheraConfiguration', $config);
    }
    
    public function testGetExtensionFactories_ByDefault_ReturnsEmptyArray() {
        $factories = $this->config->getExtensionFactories();
        $this->assertEquals(0, \count($factories));
    }
    
    public function testGetExtensionFactories_FactoryAdded_ReturnsArrayWithFactory() {
        $factory = $this->getMock(__NAMESPACE__ . '\\ExtensionFactory');
        $this->config->addExtensionFactory($factory);
        
        $factories = $this->config->getExtensionFactories();
        $this->assertEquals(1, \count($factories));
        $this->assertSame($factory, $factories[0]);
    }
    
    public function testNewFactoryInstance_EmptyEnv_ReturnsDefaultFactory() {
        $factory = $this->config->newFactoryInstance($this->aphera);
        $this->assertType(Constants::DEFAULT_FACTORY, $factory);
    }
    
    public function testNewFactoryInstance_CustomEnvFactory_ReturnsDefaultFactory() {
        $customFactory = $this->getMock(__NAMESPACE__ . '\\Factory');
        $customFactoryClass = \get_class($customFactory);
        
        $this->config->setTestEnvirmentVariable(Constants::CONFIG_FACTORY, $customFactoryClass);
        $factory = $this->config->newFactoryInstance($this->aphera);
        
        $this->assertType($customFactoryClass, $factory);
    }
    
    public function testNewParserInstance_EmptyEnv_ReturnsDefaultParser() {
        $parser = $this->config->newParserInstance($this->aphera);
        $this->assertType(Constants::DEFAULT_PARSER, $parser);
    }
    
    public function testNewParserInstance_CustomEnvParser_ReturnsDefaultParser() {
        $customParser = $this->getMock(__NAMESPACE__ . '\\Parser');
        $customParserClass = \get_class($customParser);
        
        $this->config->setTestEnvirmentVariable(Constants::CONFIG_PARSER, $customParserClass);
        $parser = $this->config->newParserInstance($this->aphera);
        
        $this->assertType($customParserClass, $parser);
    }
}