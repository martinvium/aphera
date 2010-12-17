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
    
    public function testNewEntry_GetContentElement_ReturnsElement() {
        $entry = $this->factory->newEntry();
        $entry->setContent('test');
        $content = $entry->getContentElement();
        $this->assertEquals(Core\Constants::CONTENT, $content->getTagName());
        $this->assertEquals('test', $content->nodeValue);
    }
    
    public function testNewEntry_GetContent_ReturnsValue() {
        $entry = $this->factory->newEntry();
        $entry->setContent('test');
        $this->assertEquals('test', $entry->getContent());
    }
    
    public function testNewEntry_GetSummaryElement_ReturnsElement() {
        $entry = $this->factory->newEntry();
        $entry->setSummary('test');
        $summary = $entry->getSummaryElement();
        $this->assertEquals(Core\Constants::SUMMARY, $summary->getTagName());
        $this->assertEquals('test', $summary->nodeValue);
    }
    
    public function testNewEntry_GetSummary_ReturnsValue() {
        $entry = $this->factory->newEntry();
        $entry->setSummary('test');
        $this->assertEquals('test', $entry->getSummary());
    }
    
    public function testNewEntry_GetTitleElement_ReturnsElement() {
        $entry = $this->factory->newEntry();
        $entry->setTitle('test');
        $element = $entry->getTitleElement();
        $this->assertEquals(Core\Constants::TITLE, $element->getTagName());
        $this->assertEquals('test', $element->nodeValue);
    }
    
    public function testNewEntry_GetTitle_ReturnsValue() {
        $entry = $this->factory->newEntry();
        $entry->setTitle('test');
        $this->assertEquals('test', $entry->getTitle());
    }
    
    public function testNewTitle_GetTagName_ReturnsTitle() {
        $title = $this->factory->newTitle();
        $this->assertEquals('title', $title->getTagName());
    }
    
    public function testBla_Scenario_Assertions()
    {
        
    }
}

class Foo extends \DOMElement
{
    public function test()
    {
        
    }
}