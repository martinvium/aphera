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

use Aphera\Server\Provider\BasicProvider;
use Aphera\Server\Context\DefaultRequestContext;

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/bootstrap.php');

class BasicWorkspaceManagerTest extends \PHPUnit_Framework_TestCase
{
    const BASE_URI = 'http://www.example.com/api';

    /**
     * @var BasicWorkspaceManager
     */
    protected $manager;

    protected $provider;
    
    public function setUp() {
        parent::setUp();

        $this->provider = new BasicProvider();
        $this->manager = new BasicWorkspaceManager();
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testGetCollectionAdapter_EmptyUri_ThrowsInvalidArgumentException() {
        $adapter = $this->getMockForAbstractClass('\\Aphera\\Server\\Adapter\\AbstractEntityCollectionAdapter');
        $this->manager->registerCollectionAdapter('hello', get_class($adapter));

        $returnedAdapter = $this->manager->getCollectionAdapter($this->makeRequest('POST', ''));
        $this->assertEquals(get_class($adapter), $returnedAdapter);
    }

    public function testGetCollectionAdapter_HelloFeedUri_ReturnsHelloAdapter() {
        $adapter = $this->getMockForAbstractClass('\\Aphera\\Server\\Adapter\\AbstractEntityCollectionAdapter');
        $this->manager->registerCollectionAdapter('hello', get_class($adapter));

        $returnedAdapter = $this->manager->getCollectionAdapter($this->makeRequest('POST', self::BASE_URI . '/hello'));
        $this->assertEquals(get_class($adapter), get_class($returnedAdapter));
    }

    protected function makeRequest($method, $uri) {
        return new DefaultRequestContext($this->provider, $method, $uri, self::BASE_URI);
    }
}