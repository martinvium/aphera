<?php
namespace Tests\Aphera\Core;

use Aphera\Core\Aphera;
use Aphera\Core\Configuration;

require_once(dirname(dirname(dirname(__FILE__))) . '/bootstrap.php');

class ApheraTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Aphera
     */
    protected $aphera;
    
    /**
     * @var Configuration
     */
    protected $config;

    protected function setUp() {
        parent::setUp();
        $this->config = $this->makeConfiguration();
        $this->aphera = new Aphera($this->config);
    }
    
    public function testConstruct_EmptyConfig_LoadsApheraConfig() {
        $this->aphera = new Aphera();
        $config = $this->aphera->getConfiguration();
        $this->assertInstanceOf('Aphera\\Core\\ApheraConfiguration', $config);
    }

    public function testGetFactory_CallOnce_CallsConfigurationWithAphera() {
        $this->config->expects($this->once())
                     ->method('newFactoryInstance')
                     ->with($this->aphera);
        
        $this->aphera->getFactory();
    }
    
    public function testGetFactory_CallTwice_CallsConfigurationOnce() {
        $this->config->expects($this->once())
                     ->method('newFactoryInstance')
                     ->will($this->returnValue(true));
        
        $this->aphera->getFactory();
        $this->aphera->getFactory();
    }

    public function testGetParser_ReturnsParser() {
        $factory = $this->getMock('\\Aphera\\Core\\Factory');
        $factory->expects($this->any())
                ->method('newParser')
                ->will($this->returnValue('myParser'));

        $this->config->expects($this->once())
                     ->method('newFactoryInstance')
                     ->will($this->returnValue($factory));

        $parser = $this->aphera->getParser();
        $this->assertEquals('myParser', $parser);
    }
    
    public function testGetParser_CallTwice_CallsNewParserOnce() {
        
        $factory = $this->getMock('\\Aphera\\Core\\Factory');
        $factory->expects($this->once())
                ->method('newParser')
                ->will($this->returnValue('myParser'));

        $this->config->expects($this->once())
                     ->method('newFactoryInstance')
                     ->will($this->returnValue($factory));

        $this->aphera->getParser();
        $this->aphera->getParser();
    }

    public function testGetConfiguration_Scenario_ReturnsConfiguration() {
        $config = $this->aphera->getConfiguration();
        $this->assertSame($this->config, $config);
    }
    
    protected function makeConfiguration() {
        return $this->getMock('Aphera\\Core\\Configuration');
    }
}