<?php
namespace Tests\Aphera\Parser\DOM;

use Aphera\Core;
use Aphera\Parser\DOM;

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/Bootstrap.php');

class EntryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Core\Factory
     */
    protected $factory;
    
    protected function setUp() {
        parent::setUp();
        
        $this->aphera = new Core\Aphera();
        $this->factory = $this->aphera->getFactory();
        
        $entry = $this->factory->newEntry();
        $entry->setId('testid');
        $entry->setTitle('testtitle');
        $entry->setSummary('testsummary');
        $entry->setContent('testcontent');
        $this->entry = $entry;
    }
    
    public function testNewEntry_GetContentElement_ReturnsElement() {
        $element = $this->entry->getContentElement();
        $this->assertEquals(Core\Constants::CONTENT, $element->getTagName());
        $this->assertEquals('testcontent', $element->nodeValue);
    }
    
    public function testNewEntry_GetContent_ReturnsValue() {
        $this->assertEquals('testcontent', $this->entry->getContent());
    }
    
    public function testNewEntry_GetSummaryElement_ReturnsElement() {
        $element = $this->entry->getSummaryElement();
        $this->assertEquals(Core\Constants::SUMMARY, $element->getTagName());
        $this->assertEquals('testsummary', $element->nodeValue);
    }
    
//    public function testNewEntry_GetSummary_ReturnsValue() {
//        $this->assertEquals('testsummary', $this->entry->getSummary());
//    }
//    
//    public function testNewEntry_GetTitleElement_ReturnsElement() {
//        $element = $this->entry->getTitleElement();
//        $this->assertEquals(Core\Constants::TITLE, $element->getTagName());
//        $this->assertEquals('testtitle', $element->nodeValue);
//    }
//    
//    public function testNewEntry_GetTitle_ReturnsValue() {
//        $this->assertEquals('testtitle', $this->entry->getTitle());
//    }
}