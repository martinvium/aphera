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
namespace Aphera\Server\Adapter;

use Aphera\Server\ResponseContext;
use Aphera\Core\Aphera;
use Aphera\Server\Context\DefaultRequestContext;
use Aphera\Server\Context\StreamRequestContext;

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/bootstrap.php');

/**
 * @group disable2
 */
class AbstractEntityCollectionAdapterTest extends \PHPUnit_Framework_TestCase
{
    const BASE_URI = '';
    
    /**
     * @var AbstractCollectionAdapter
     */
    protected $adapter;
    
    /**
     * @var Aphera\Server\RequestContext
     */
    protected $request;

    protected $stream;

    protected $provider;

    protected $inputStream;

    public function setUp() {
        parent::setUp();
        
        $this->provider = new \Aphera\Server\Provider\BasicProvider();
        $this->provider->init(new Aphera());
        
        $this->adapter = $this->getMockForAbstractClass('\\Aphera\\Server\\Adapter\\AbstractEntityCollectionAdapter');

        $this->stream = \fopen('php://memory', 'w');
        $this->inputStream = \fopen('php://memory', 'r');
    }
    
    public function testPostEntry_EmptyRequestBody_Returns400Response() {
        $response = $this->adapter->postEntry($this->makeRequest('POST', self::BASE_URI));
        $this->assertEquals(400, $response->getStatus());
    }

    protected function makeRequest($method, $uri) {
        return new StreamRequestContext($this->stream, $this->provider, $method, $uri, self::BASE_URI);
    }
}