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
namespace Aphera\Adapter\Example;

use Aphera\Adapter\Example\EmployeeCollectionAdapter;

use Aphera\Core\Aphera;

use Aphera\Server\Provider\BasicProvider;
use Aphera\Server\Context\StreamRequestContext;
use Aphera\Server\ResponseContext;
use Aphera\Core\TestCase;

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/bootstrap.php');

class EmployeeIntegrationTest extends TestCase
{
    const BASE_URI = 'http://www.example.org/api/';

    /**
     * @var BasicProvider
     */
    protected $provider;

    protected $entryFilename;

    protected $entryStream;

    protected $outStream;
    
    public function setUp() {
        parent::setUp();

        $this->provider = new BasicProvider();
        $this->provider->getWorkspaceManager()->registerCollectionAdapter('employees', EmployeeCollectionAdapter::getClass());
        $this->provider->init($this->aphera);

        $this->entryFilename = \dirname(__FILE__) . '/_files/simpleEntry.xml';
        $this->entryStream = \fopen($this->entryFilename, 'r');

        $this->outStream = $this->makeMemoryStream();
    }

    public function  tearDown() {
        parent::tearDown();
    }

    public function testProcess_PostEntry_Returns201Response() {
        $uri = self::BASE_URI . 'employees';
        $request = $this->makeRequest($this->entryStream, 'POST', $uri);

        $response = $this->provider->process($request);

        $this->assertEquals(201, $response->getStatus());
        $this->assertEquals('Created', $response->getStatusText());
        $this->assertEquals('Atom-Powered Robots Run Amok', $response->getEntity()->getTitle());
        $this->assertEquals('prefix0', $response->getEntity()->getId());
        $this->assertInstanceOf('DateTime', $response->getEntity()->getUpdated());
    }

    public function testProcess_GetFeed_Returns200Response() {
        $uri = self::BASE_URI . 'employees';
        $this->provider->process($this->makeRequest($this->entryStream, 'POST', $uri));
        $this->provider->process($this->makeRequest($this->entryStream, 'POST', $uri));
        $this->provider->process($this->makeRequest($this->entryStream, 'POST', $uri));

        $request = $this->makeRequest($this->outStream, 'GET', $uri);
        $response = $this->provider->process($request);

        $this->assertEquals(200, $response->getStatus());
        $this->assertInstanceOf('\\Aphera\\Model\\Feed', $response->getEntity());
        $this->assertEquals(3, \count($response->getEntity()->getEntries()));
    }
    
    protected function makeRequest($stream, $method, $uri) {
        \rewind($stream);
        return new StreamRequestContext($stream, $this->provider, $method, $uri, self::BASE_URI);
    }
}