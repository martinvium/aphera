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

class ContentTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var DOM\Factory
     */
    protected $factory;
    
    /**
     * @var DOM\Content
     */
    protected $content;
    
    protected function setUp() {
        parent::setUp();
        
        $this->aphera = new Core\Aphera();
        $this->factory = $this->aphera->getFactory();
        
        $this->content = $this->makeContent();
    }
    

    public function testGetContentType_Scenario_Assertions() {
        $this->content->setContentType('text');
        $this->assertEquals('text', $this->content->getContentType());
    }
    
    public function testGetSrc_Scenario_Assertions() {
        $this->content->setSrc('http://www.example.org');
        $this->assertEquals('http://www.example.org', $this->content->getSrc());
    }
    
    public function testGetValue_Text_ReturnsStringValue() {
        $this->content->setContentType("text");
        $this->content->setValue("test");
        $this->assertEquals("test", $this->content->getValue());
    }
    
    public function testGetValueElement_Xml_ReturnsElement() {
        $this->content->setContentType('xml');
        $this->content->setValueElement($this->makeExampleElement());
        
        $element = $this->content->getValueElement();
        $this->assertType('\\Aphera\\Model\\Element', $element);
        $this->assertEquals("example", $element->getTagName());
    }
    
    public function testGetValueElement_Text_ReturnsNull() {
        $this->content->setContentType('text');
        $this->content->setValueElement($this->makeExampleElement());
        
        $this->assertNull($this->content->getValueElement());
    }
    
    protected function makeContent() {
        $doc = $this->factory->newDocument();
        $root = $this->makeExampleElement();
        $doc->appendChild($root);
        return $this->factory->newContent($root);
    }
    
    protected function makeExampleElement() {
        return $this->factory->newElement('example');
    }
}