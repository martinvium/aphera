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
namespace Aphera\Server\Provider;

use Aphera\Server\Provider\BasicWorkspace;
use Aphera\Core\Aphera;
use Aphera\Core\TestCase;

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/bootstrap.php');

class BasicWorkspaceTest extends TestCase
{
    /**
     * @var BasicWorkspace
     */
    protected $workspace;

    protected $request;

    protected $aphera;

    public function setUp() {
        parent::setUp();

        $this->aphera = new Aphera();
        $this->workspace = new BasicWorkspace();
        $this->request = $this->getMock('\\Aphera\\Server\\RequestContext');
        $this->request->expects($this->any())->method('getAphera')->will($this->returnValue($this->aphera));
    }

    public function testGetTitle_Scenario_Assertions() {
        $this->workspace->setTitle('mytitle');
        $this->assertEquals('mytitle', $this->workspace->getTitle($this->request));
    }

    public function testGetCollections_Scenario_Assertions() {
        $collection = $this->getMock('\\Aphera\\Server\\CollectionInfo');
        $this->workspace->addCollection($collection);

        $collections = $this->workspace->getCollections($this->request);

        $this->assertEquals(1, count($collections));
        $this->assertEquals($collection, $collections[0]);
    }

    public function testAsCollectionElement_Scenario_Assertions() {
        $collection = $this->getMockForAbstractClass('\\Aphera\\Server\\Adapter\\AbstractCollectionAdapter');
        $collection->expects($this->any())->method('getTitle')->will($this->returnValue('mycollectiontitle'));
        $this->workspace->addCollection($collection);
        $this->workspace->setTitle('mytitle');

        $workspaceElement = $this->workspace->asWorkspaceElement($this->request, $this->aphera->getFactory()->newEntry());

        $this->assertEquals('mytitle', $workspaceElement->getTitle());
        $collectionElements = $workspaceElement->getCollections();
        $this->assertEquals(1, \count($collectionElements));
        $this->assertEquals('mycollectiontitle', $collectionElements[0]->getTitle());
    }
}