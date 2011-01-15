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

class RouteTest extends \PHPUnit_Framework_TestCase
{
    const PATTERN_SERVICE = '/';
    const PATTERN_FEED = '/:feed/';
    const PATTERN_ENTRY = '/:feed/:entry/';

    /**
     * @var Route
     */
    protected $route;

    public function setUp() {
        parent::setUp();
    }
    
    public function testParse_ServicePatternServiceUri_ReturnsEmptyArray() {
        $this->route = $this->makeRoute(self::PATTERN_SERVICE);
        $parameters = $this->route->parse('/');
        $this->assertEquals(array(), $parameters);
    }
    
    public function testParse_ServicePatternEntryUri_ReturnsEmptyArray() {
        $this->route = $this->makeRoute(self::PATTERN_SERVICE);
        $parameters = $this->route->parse('/hello/there');
        $this->assertEquals(array(), $parameters);
    }

    public function testParse_EntryPatternEntryUri_ReturnsTwoParameters() {
        $this->route = $this->makeRoute(self::PATTERN_ENTRY);
        $parameters = $this->route->parse('/hello/there/');
        $this->assertEquals(array('entry' => 'there', 'feed' => 'hello'), $parameters);
    }
    
    public function testParse_EntryPatternEntryUriNoEndingSlash_ReturnsTwoParameters() {
        $this->route = $this->makeRoute(self::PATTERN_ENTRY);
        $parameters = $this->route->parse('/hello/there');
        $this->assertEquals(array('entry' => 'there', 'feed' => 'hello'), $parameters);
    }

    public function testParse_EntryPatternServiceUri_ReturnsTwoNullParameters() {
        $this->route = $this->makeRoute(self::PATTERN_ENTRY);
        $parameters = $this->route->parse('/');
        $this->assertEquals(array('entry' => null, 'feed' => null), $parameters);
    }

    public function testMatch_EntryPatternServiceUri_ReturnsFalse() {
        $this->route = $this->makeRoute(self::PATTERN_ENTRY);
        $this->assertFalse($this->route->match('/'));
    }

    public function testMatch_EntryPatternEntryUri_ReturnsFalse() {
        $this->route = $this->makeRoute(self::PATTERN_ENTRY);
        $this->assertTrue($this->route->match('/hello/there'));
    }

    protected function makeRoute($pattern, $name = 'test', $target = Target::TYPE_ENTRY) {
        return new Route($name, $pattern, $name);
    }
}