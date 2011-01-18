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
        $this->assertInstanceOf(__NAMESPACE__ . '\\Writer', $writer);
    }

    public function testNewWorkspace_NoParent_ReturnsWorkspace() {
        $workspace = $this->factory->newWorkspace();
        $this->assertInstanceOf(__NAMESPACE__ . '\\Workspace', $workspace);
    }

    public function testNewCollection_Scenario_ReturnsCollection() {
        $collection = $this->factory->newCollection();
        $this->assertInstanceOf(__NAMESPACE__ . '\\Collection', $collection);
    }
}