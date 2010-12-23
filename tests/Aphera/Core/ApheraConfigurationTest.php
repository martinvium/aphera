<?php
namespace Aphera\Core;

require_once(dirname(dirname(dirname(__FILE__))) . '/bootstrap.php');

class ApheraConfigurationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Aphera
     */
    protected $aphera;
    
    /**
     * @var TestAsset\TestConfiguration
     */
    protected $config;

    protected function setUp() {
        parent::setUp();
        $this->aphera = new Aphera();
        $this->config = new TestAsset\TestConfiguration();
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