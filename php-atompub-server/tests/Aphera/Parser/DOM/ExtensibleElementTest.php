<?php
namespace Tests\Aphera\Parser\DOM;

use Aphera\Core;
use Aphera\Parser\DOM;

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/Bootstrap.php');

class ExtensibleElementTest extends \PHPUnit_Framework_TestCase
{
    const TEST_NAMESPACE = 'http://www.example.org/';
    
    /**
     * @var Core\Factory
     */
    protected $factory;
    
    /**
     * @var DOM\ExtensibleElement
     */
    protected $element;
    
    protected function setUp() {
        parent::setUp();
        
        $this->aphera = new Core\Aphera();
        $this->factory = $this->aphera->getFactory();
        
        $doc = $this->factory->newDocument();
        $this->element = $this->factory->newElement('test');
        $doc->appendChild($this->element);
        
        $this->changeElementAddChildren();
    }
    
    public function testGetFirstChildByTagName_LocalNameSummary_ReturnsSummaryElement() {
        $elementName = $this->element->getFirstChildByTagName("summary")->localName;
        $this->assertEquals("summary", $elementName);
    }
    
    public function testGetFirstChildByTagName_LocalNameSummary2_ReturnsSummary2Element() {
        $elementName = $this->element->getFirstChildByTagName("summary2")->localName;
        $this->assertEquals("summary2", $elementName);
    }
    
    public function testGetFirstChildByTagName_NamespaceChild_ReturnsNamespaceChild() {
        $this->changeElementAddNSChild();
        $element = $this->element->getFirstChildByTagName("summary", self::TEST_NAMESPACE);
        $this->assertEquals("summary", $element->localName);
        $this->assertEquals(self::TEST_NAMESPACE, $element->namespaceURI);
    }
    
    protected function changeElementAddChildren() {
        $this->element->appendChild($this->factory->newElement('summary'));
        $this->element->appendChild($this->factory->newElement('summary2'));
    }
    
    protected function changeElementAddNSChild() {
        $this->element->appendChild($this->factory->newElement('summary', self::TEST_NAMESPACE));
    }
}