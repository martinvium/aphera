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

use Aphera\Core\Constants;
use Aphera\Core\Aphera;

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/bootstrap.php');

class WorkspaceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Core\Factory
     */
    protected $factory;

    protected $workspace;
    
    protected function setUp() {
        parent::setUp();
        
        $this->aphera = new Aphera();
        $this->factory = $this->aphera->getFactory();
        
        $this->workspace = $this->factory->newWorkspace($this->factory->newEntry());
        $this->workspace->setTitle('testtitle');
        $this->workspace->addCollection($this->factory->newCollection());
    }
    
    public function testGetTitle_Scenario_ReturnsValue() {
        $this->assertEquals('testtitle', $this->workspace->getTitle());
    }

    public function testAddCollection_Scenario_ReturnsValue() {
        $this->assertEquals('testtitle', $this->workspace->getTitle());
    }

    public function testGetCollections_OneCollection_ReturnsOneCollection() {
        $collections = $this->workspace->getCollections();
        $this->assertEquals(1, count($collections));
    }
}