<?php
/**
 * Copyright 2011 Martin Vium
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
namespace Tests\Aphera\Parser\DOM;

use Aphera\Core;
use Aphera\Parser\DOM;

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/bootstrap.php');

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
    
    public function testGetChildrenWithName_OnlyLocalName_ReturnBoth() {
        $this->changeElementAddNSChild();
        $elements = $this->element->getChildrenWithName("summary");
        $this->assertEquals(2, count($elements));
        $this->assertEquals("summary", $elements[0]->localName);
        $this->assertEquals("summary", $elements[1]->localName);
        $this->assertEquals(self::TEST_NAMESPACE, $elements[1]->namespaceURI);
    }

    public function testRemoveChildren_Scenario_Assertions() {
        $this->element->removeChildren("summary");
        $elements = $this->element->getChildrenWithName("summary");
        $this->assertEquals(0, count($elements));
    }
    
    protected function changeElementAddChildren() {
        $this->element->appendChild($this->factory->newElement('summary'));
        $this->element->appendChild($this->factory->newElement('summary2'));
    }
    
    protected function changeElementAddNSChild() {
        $this->element->appendChild($this->factory->newElement('summary', self::TEST_NAMESPACE));
    }
}