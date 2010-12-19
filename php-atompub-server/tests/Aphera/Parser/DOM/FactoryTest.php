<?php
namespace Tests\Aphera\Parser\DOM;

use Aphera\Core;
use Aphera\Parser\DOM;

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/Bootstrap.php');

class FactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Core\Factory
     */
    protected $factory;
    
    protected function setUp() {
        parent::setUp();
        
        $this->aphera = new Core\Aphera();
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
}