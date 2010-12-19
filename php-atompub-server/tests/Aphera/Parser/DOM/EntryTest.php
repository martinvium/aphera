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
        $entry->addLink('testnorel');
        $entry->addLink('testnotitle', 'testrel');
        $entry->addLink('testall', 'testrel2', 'testtitle');
        $this->entry = $entry;
    }
    
    public function testGetContentElement_GetContentElement_ReturnsElement() {
        $element = $this->entry->getContentElement();
        $this->assertEquals(Core\Constants::CONTENT, $element->getTagName());
        $this->assertEquals('testcontent', $element->nodeValue);
    }
    
    public function testGetContent_GetContent_ReturnsValue() {
        $this->assertEquals('testcontent', $this->entry->getContent());
    }
    
    public function testGetSummaryElement_GetSummaryElement_ReturnsElement() {
        $element = $this->entry->getSummaryElement();
        $this->assertEquals(Core\Constants::SUMMARY, $element->getTagName());
        $this->assertEquals('testsummary', $element->nodeValue);
    }
    
    public function testGetSummary_GetSummary_ReturnsValue() {
        $this->assertEquals('testsummary', $this->entry->getSummary());
    }
    
    public function testGetTitleElement_GetTitleElement_ReturnsElement() {
        $element = $this->entry->getTitleElement();
        $this->assertEquals(Core\Constants::TITLE, $element->getTagName());
        $this->assertEquals('testtitle', $element->nodeValue);
    }
    
    public function testGetTitle_GetTitle_ReturnsValue() {
        $this->assertEquals('testtitle', $this->entry->getTitle());
    }
    
    public function testGetIdElement_GetTitleElement_ReturnsElement() {
        $element = $this->entry->getIdElement();
        $this->assertEquals(Core\Constants::ID, $element->getTagName());
        $this->assertEquals('testid', $element->nodeValue);
    }
    
    public function testGetId_GetTitle_ReturnsValue() {
        $this->assertEquals('testid', $this->entry->getId());
    }
    
    public function testGetLinks_NoRel_ReturnsAll() {
        $links = $this->entry->getLinks();
        $this->assertEquals("testnorel", $links[0]->getHref());
        $this->assertEquals("testnotitle", $links[1]->getHref());
        $this->assertEquals("testall", $links[2]->getHref());
    }
    
    public function testGetLinks_RelOne_ReturnsLinkTwo() {
        $links = $this->entry->getLinks("testrel");
        $this->assertEquals("testnotitle", $links[0]->getHref());
    }
}