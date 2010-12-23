<?php
namespace Aphera\Parser\DOM;

use Aphera\Core\Aphera;

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/bootstrap.php');

class FactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Factory
     */
    protected $factory;
    
    protected function setUp() {
        parent::setUp();
        
        $this->aphera = new Aphera();
        $this->factory = $this->aphera->getFactory();
    }
    
	public function testNewEntry_GetTagName_ReturnsEntry() {
        $entry = $this->factory->newEntry();
        $this->assertEquals('entry', $entry->getTagName());
    }
    
    public function testNewTitle_GetTagName_ReturnsTitle() {
        $title = $this->factory->newTitle();
        $this->assertEquals('title', $title->getTagName());
    }
    
    public function testNewWriter_Scenario_ReturnsWriter() {
        $writer = $this->factory->newWriter();
        $this->assertType(__NAMESPACE__ . '\\Writer', $writer);
    }
}