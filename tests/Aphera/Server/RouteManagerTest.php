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
namespace Aphera\Server;

use Aphera\Core\Protocol\Target;

require_once(dirname(dirname(dirname(__FILE__))) . '/bootstrap.php');

class RouteManagerTest extends \PHPUnit_Framework_TestCase
{
    const PATTERN_SERVICE = '/';
    const PATTERN_FEED = '/:feed/';
    const PATTERN_ENTRY = '/:feed/:entry/';

    /**
     * @var RouteManager
     */
    protected $manager;

    public function setUp() {
        parent::setUp();
        $this->manager = new RouteManager();
    }
    
    public function testResolve_ServiceUri_ReturnsServiceAction() {
        $this->changeManagerAddAllRoutes();
        $target = $this->manager->resolve($this->makeRequest('/'));
        $this->assertInstanceOf('\\Aphera\\Server\\RouteTarget', $target);
        $this->assertEquals(Target::TYPE_SERVICE, $target->getType());
        $this->assertEquals(array(), $target->getParameters());
    }

    public function testResolve_FeedUri_ReturnsFeedAction() {
        $this->changeManagerAddAllRoutes();
        $target = $this->manager->resolve($this->makeRequest('/hello'));
        $this->assertInstanceOf('\\Aphera\\Server\\RouteTarget', $target);
        $this->assertEquals(Target::TYPE_COLLECTION, $target->getType());
        $this->assertEquals(array('feed' => 'hello'), $target->getParameters());
    }

    public function testResolve_EntryUri_ReturnsEntryAction() {
        $this->changeManagerAddAllRoutes();
        $target = $this->manager->resolve($this->makeRequest('/hello/there'));
        $this->assertInstanceOf('\\Aphera\\Server\\RouteTarget', $target);
        $this->assertEquals(Target::TYPE_ENTRY, $target->getType());
        $this->assertEquals(array('feed' => 'hello', 'entry' => 'there'), $target->getParameters());
    }

    public function testResolve_UnknownUri_ReturnsEntryAction() {
        $this->changeManagerAddAllRoutes();
        $target = $this->manager->resolve($this->makeRequest('/hello/there/unknown'));
        $this->assertNull($target);
    }

    public function testAddSimpleRoute_MixedParams_ResolveReturnsEntryAction() {
        $this->manager->addSimpleRoute('test', self::PATTERN_ENTRY, Target::TYPE_CATEGORIES);
        $target = $this->manager->resolve($this->makeRequest('/hello/there'));
        $this->assertInstanceOf('\\Aphera\\Server\\RouteTarget', $target);
        $this->assertEquals(Target::TYPE_CATEGORIES, $target->getType());
        $this->assertEquals(array('feed' => 'hello', 'entry' => 'there'), $target->getParameters());
    }

    public function testAddSimpleRoute_MixedParams_ReturnsManager() {
        $actual = $this->manager->addSimpleRoute('test', self::PATTERN_ENTRY, Target::TYPE_CATEGORIES);
        $this->assertInstanceOf('\\Aphera\\Server\\RouteManager', $actual);
    }

    public function testResolve_EmployeesFeed_ReturnsCollectionAction() {
        $this->changeManagerAddAllRoutes();
        $target = $this->manager->resolve($this->makeRequest('employees'));
        $this->assertInstanceOf('\\Aphera\\Server\\RouteTarget', $target);
        $this->assertEquals(Target::TYPE_COLLECTION, $target->getType());
        $this->assertEquals(array('feed' => 'employees'), $target->getParameters());
    }

    protected function makeRequest($uri) {
        $request = $this->getMock('\\Aphera\\Server\\RequestContext');
        $request->expects($this->any())
                ->method('getTargetPath')
                ->will($this->returnValue($uri));
        return $request;
    }

    protected function changeManagerAddAllRoutes() {
        $this->manager->addRoute(new Route('service', self::PATTERN_SERVICE, Target::TYPE_SERVICE))
                      ->addRoute(new Route('feed', self::PATTERN_FEED, Target::TYPE_COLLECTION))
                      ->addRoute(new Route('entry', self::PATTERN_ENTRY, Target::TYPE_ENTRY));
    }
}