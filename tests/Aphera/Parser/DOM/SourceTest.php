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
        $doc->appendChild($root);
        
        $this->source = $this->factory->newSource($root);
        $this->source->setTitle('testtitle');
        $this->source->setId('testid');
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