<?php
namespace Tests\Aphera\Parser\DOM;

use Aphera\Core;
use Aphera\Parser\DOM;

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/bootstrap.php');

class SourceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var DOM\Factory
     */
    protected $factory;
    
    /**
     * @var DOM\Source
     */
    protected $source;
    
    protected function setUp() {
        parent::setUp();
        
        $aphera = new Core\Aphera();
        $this->factory = $aphera->getFactory();
        $doc = $this->factory->newDocument();
        $root = $this->factory->newElement('test');
        $doc->appendChild($doc);
        
        $this->source = $this->factory->newSource($root);
        $this->source->addLink('testnorel');
        $this->source->addLink('testnotitle', 'testrel');
        $this->source->addLink('testall', 'testrel2', 'testtitle');
    }
    
    public function testGetTitleElement_GetTitleElement_ReturnsElement() {
        $element = $this->source->getTitleElement();
        $this->assertEquals(Core\Constants::TITLE, $element->getTagName());
        $this->assertEquals('testtitle', $element->getValue());
    }
    
    public function testGetTitle_GetTitle_ReturnsValue() {
        $this->assertEquals('testtitle', $this->source->getTitle());
    }
    
    public function testGetIdElement_GetTitleElement_ReturnsElement() {
        $element = $this->source->getIdElement();
        $this->assertEquals(Core\Constants::ID, $element->getTagName());
        $this->assertEquals('testid', $element->getValue());
    }
    
    public function testGetId_GetTitle_ReturnsValue() {
        $this->assertEquals('testid', $this->source->getId());
    }
    
    public function testGetLinks_NoRel_ReturnsAll() {
        $links = $this->source->getLinks();
        $this->assertEquals("testnorel", $links[0]->getHref());
        $this->assertEquals("testnotitle", $links[1]->getHref());
        $this->assertEquals("testall", $links[2]->getHref());
    }
    
    public function testGetLinks_RelOne_ReturnsLinkTwo() {
        $links = $this->source->getLinks("testrel");
        $this->assertEquals("testnotitle", $links[0]->getHref());
    }
}