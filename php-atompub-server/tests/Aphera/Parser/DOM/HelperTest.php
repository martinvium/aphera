<?php
namespace Tests\Aphera\Parser\DOM;

use Aphera\Core;
use Aphera\Parser\DOM;

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/bootstrap.php');

class HelperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Core\Factory
     */
    protected static $factory;
    
    /**
     * @var Model\Feed
     */
    protected static $feed;
    
    protected function setUp() {
        parent::setUp();
        
        $aphera = new Core\Aphera();
        self::$factory = $aphera->getFactory();
        self::$feed = self::$factory->newFeed();
        $this->changeFeedAddEmptyEntries();
    }
    
    public function testGetElementsWithChildElementValue_Scenario_Assertions() {
        $entries = self::$feed->getEntries();
        
        $id = "test2";
        $filteredEntries = DOM\Helper::getElementsWithChildElementValue($entries, Core\Constants::ID, $id, Core\Constants::ATOM_NS);
        
        $this->assertEquals(1, count($filteredEntries));
        $this->assertEquals("test2", $filteredEntries[0]->getId());
    }
    
    public function testGetFirstElementWithChildElementValue_Scenario_Assertions() {
        $entries = self::$feed->getEntries();
        
        $id = "test2";
        $element = DOM\Helper::getFirstElementWithChildElementValue($entries, Core\Constants::ID, $id, Core\Constants::ATOM_NS);
        
        $this->assertType("Aphera\\Parser\\DOM\\Entry", $element);
        $this->assertEquals("test2", $element->getId());
    }
    
    public function changeFeedAddEmptyEntries() {
        self::$feed->addEntry()->setId('test1');
        self::$feed->addEntry()->setId('test2');
        self::$feed->addEntry()->setId('test3');
    }
}