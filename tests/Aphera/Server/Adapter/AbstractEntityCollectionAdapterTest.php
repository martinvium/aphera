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
use Aphera\Core\TestCase;

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/bootstrap.php');

class AbstractEntityCollectionAdapterTest extends TestCase
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
        $this->provider->init($this->aphera);
        
        $this->adapter = $this->getMockForAbstractClass('\\Aphera\\Server\\Adapter\\AbstractEntityCollectionAdapter');
    }
    
    public function testPostEntry_EmptyRequestBody_Returns400Response() {
        $request = $this->makeRequest($this->makeMemoryStream(), 'POST', self::BASE_URI);
        $response = $this->adapter->postEntry($request);
        $this->assertEquals(400, $response->getStatus());
    }

    public function testPostEntry_MalformedRequestBody_Returns400Response() {
        $request = $this->makeRequest($this->makeFileStream('malformed.xml'), 'POST', self::BASE_URI);
        $response = $this->adapter->postEntry($request);
        $this->assertEquals(400, $response->getStatus());
    }

    public function testPostEntry_SimpleEntry_Returns201Response() {
        $request = $this->makeRequest($this->makeFileStream('simpleEntry.xml'), 'POST', self::BASE_URI);
        $response = $this->adapter->postEntry($request);
        $this->assertEquals(201, $response->getStatus());
        $this->assertEquals('Created', $response->getStatusText());
    }

    public function testPutEntry_DifferentId_Returns209Response() {
        $this->adapter->expects($this->any())->method('getEntityFromResourceName')->will($this->returnValue(true));
        $this->adapter->expects($this->any())->method('getEntityUpdated')->will($this->returnValue(new \DateTime()));
        $this->adapter->expects($this->any())
                      ->method('getEntityId')
                      ->will($this->returnValue('different_id'));

        $response = $this->adapter->putEntry($this->makeRequest($this->makeFileStream('simpleEntry.xml'), 'PUT', self::BASE_URI));
        
        $this->assertEquals(409, $response->getStatus());
    }

    public function testPutEntry_SimpleEntry_Returns204Response() {
        $this->adapter->expects($this->any())->method('getEntityFromResourceName')->will($this->returnValue(true));
        $this->adapter->expects($this->any())->method('getEntityUpdated')->will($this->returnValue(new \DateTime()));
        $this->adapter->expects($this->any())->method('getEntityId')->will($this->returnValue('urn:uuid:1225c695-cfb8-4ebb-aaaa-80da344efa6a'));

        $response = $this->adapter->putEntry($this->makeRequest($this->makeFileStream('simpleEntry.xml'), 'PUT', self::BASE_URI));

        $this->assertEquals(204, $response->getStatus());
    }

    public function testPutEntry_SimpleEntry_CallPutEntryWithCollectionProvider() {
        $this->adapter->expects($this->any())->method('getEntityFromResourceName')->will($this->returnValue(true));
        $this->adapter->expects($this->any())->method('getEntityUpdated')->will($this->returnValue(new \DateTime()));
        $this->adapter->expects($this->any())->method('getEntityId')->will($this->returnValue('urn:uuid:1225c695-cfb8-4ebb-aaaa-80da344efa6a'));

        $this->adapter->expects($this->once())
                      ->method('putEntryWithCollectionProvider');

        $this->adapter->putEntry($this->makeRequest($this->makeFileStream('simpleEntry.xml'), 'PUT', self::BASE_URI));
    }

    public function testPutEntry_FailToGetEntityFromResourceName_Returns404Response() {
        $this->adapter->expects($this->any())->method('getEntityFromResourceName')->will($this->returnValue(false));
        $response = $this->adapter->putEntry($this->makeRequest($this->makeMemoryStream(), 'PUT', self::BASE_URI));
        $this->assertEquals(404, $response->getStatus());
    }

    public function testGetEntry_SimpleEntry_Returns200Response() {
        $this->adapter->expects($this->any())->method('getEntityFromResourceName')->will($this->returnValue(true));
        $this->adapter->expects($this->any())->method('getEntityUpdated')->will($this->returnValue(new \DateTime()));
        $this->adapter->expects($this->any())->method('getEntityId')->will($this->returnValue('myid'));

        $response = $this->adapter->getEntry($this->makeRequest($this->makeMemoryStream(), 'GET', self::BASE_URI));

        $this->assertEquals(200, $response->getStatus());
        $this->assertResponseContains('<entry xmlns="http://www.w3.org/2005/Atom">', $response);
        $this->assertResponseContains('<id>myid</id><title></title>', $response);
        $this->assertResponseContains('</entry>', $response);
    }

    public function testGetEntry_EntityNotFound_Returns404Response() {
        $response = $this->adapter->getEntry($this->makeRequest($this->makeMemoryStream(), 'GET', self::BASE_URI));
        $this->assertEquals(404, $response->getStatus());
    }

    public function testHeadEntry_EntityFound_Returns200Response() {
        $this->adapter->expects($this->any())->method('getEntityFromResourceName')->will($this->returnValue(true));
        $response = $this->adapter->headEntry($this->makeRequest($this->makeMemoryStream(), 'HEAD', self::BASE_URI));
        $this->assertEquals(200, $response->getStatus());
    }

    public function testHeadEntry_EntityNotFound_Returns404Response() {
        $response = $this->adapter->headEntry($this->makeRequest($this->makeMemoryStream(), 'HEAD', self::BASE_URI));
        $this->assertEquals(404, $response->getStatus());
    }

    public function testGetFeed_TwoEntries_Returns200Response() {
        $this->adapter->expects($this->any())->method('getEntries')->will($this->returnValue(array(
            $this->getMock('\\Aphera\\Model\\Entry'),
            $this->getMock('\\Aphera\\Model\\Entry'),
            $this->getMock('\\Aphera\\Model\\Entry')
        )));

        $request = $this->makeRequest($this->makeMemoryStream(), 'GET', self::BASE_URI);
        $response = $this->adapter->getFeed($request);

        $this->assertEquals(200, $response->getStatus());
        $entries = $response->getEntity()->getEntries();
        $this->assertEquals(3, \count($entries));
        $this->assertInstanceOf('\\Aphera\\Model\\Entry', $entries[0]);
    }

// HELPERS
    protected function makeRequest($stream, $method, $uri) {
        return new StreamRequestContext($stream, $this->provider, $method, $uri, self::BASE_URI);
    }

    protected function makeFileStream($filename) {
        $filename = \dirname(__FILE__) . '/_files/' . $filename;
        return \fopen($filename, 'r');
    }
}