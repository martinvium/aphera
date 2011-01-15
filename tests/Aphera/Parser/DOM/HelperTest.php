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

class HelperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Core\Factory
     */
    protected static $factory;
    
    /**
     * @var Model\Feed
     */
    protected static $feed;
    
    protected function setUp() {
        parent::setUp();
        
        $aphera = new Core\Aphera();
        self::$factory = $aphera->getFactory();
        self::$feed = self::$factory->newFeed();
        $this->changeFeedAddEmptyEntries();
    }
    
    public function testGetElementsWithChildElementValue_Scenario_Assertions() {
        $entries = self::$feed->getEntries();
        
        $id = "test2";
        $filteredEntries = DOM\Helper::getElementsWithChildElementValue($entries, Core\Constants::ID, $id, Core\Constants::ATOM_NS);
        
        $this->assertEquals(1, count($filteredEntries));
        $this->assertEquals("test2", $filteredEntries[0]->getId());
    }
    
    public function testGetFirstElementWithChildElementValue_Scenario_Assertions() {
        $entries = self::$feed->getEntries();
        
        $id = "test2";
        $element = DOM\Helper::getFirstElementWithChildElementValue($entries, Core\Constants::ID, $id, Core\Constants::ATOM_NS);
        
        $this->assertType("Aphera\\Parser\\DOM\\Entry", $element);
        $this->assertEquals("test2", $element->getId());
    }
    
    public function changeFeedAddEmptyEntries() {
        self::$feed->addEntry()->setId('test1');
        self::$feed->addEntry()->setId('test2');
        self::$feed->addEntry()->setId('test3');
    }
}