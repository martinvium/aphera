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
use Aphera\Core\Aphera;

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/bootstrap.php');

class BasicProviderTest extends \PHPUnit_Framework_TestCase
{
    const BASE_URI = 'http://www.example.com/api';

    /**
     * @var BasicProvider
     */
    protected $provider;

    protected $manager;
    
    public function setUp() {
        parent::setUp();
        
        $this->provider = new BasicProvider();
//        $this->provider->init(new Aphera());
        $this->manager = $this->getMock('\\Aphera\\Server\\WorkspaceManager');
        $this->provider->setWorkspaceManager($this->manager);
    }

    public function testProcess_HelloFeedUri_ReturnsHelloAdapter() {
        $request = $this->makeRequest('POST', self::BASE_URI . '/hello');
        $adapter = $this->getMock('\\Aphera\\Server\\CollectionAdapter');
        $this->manager->expects($this->any())
                      ->method('getCollectionAdapter')
                      ->will($this->returnValue($adapter));

        $adapter->expects($this->once())
                ->method('postEntry')
                ->with($request);

        $this->provider->process($request);
    }

    protected function makeRequest($method, $uri) {
        return new DefaultRequestContext($this->provider, $method, $uri, self::BASE_URI);
    }
}