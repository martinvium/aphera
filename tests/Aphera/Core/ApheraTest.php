<?php
namespace Tests\Aphera\Core;

use Aphera\Core;

require_once(dirname(dirname(dirname(__FILE__))) . '/bootstrap.php');

class ApheraTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Core\Aphera
     */
    protected $aphera;
    
    /**
     * @var Core\Configuration
     */
    protected $config;

    protected function setUp() {
        parent::setUp();
        $this->config = $this->makeConfiguration();
        $this->aphera = new Core\Aphera($this->config);
    }
    
    public function testConstruct_EmptyConfig_LoadsApheraConfig() {
        $this->aphera = new Core\Aphera();
        $config = $this->aphera->getConfiguration();
        $this->assertType('Aphera\\Core\\ApheraConfiguration', $config);
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

    public function testGetConfiguration_Scenario_ReturnsConfiguration() {
        $config = $this->aphera->getConfiguration();
        $this->assertSame($this->config, $config);
    }
    
    protected function makeConfiguration() {
        return $this->getMock('Aphera\\Core\\Configuration');
    }
}