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

use Aphera\Server\ResponseContext;
use Aphera\Core\Aphera;
use Aphera\Server\Context\StreamRequestContext;
use Aphera\Adapter\Example\EmployeeCollectionAdapter;
use Aphera\Server\Context\DefaultRequestContext;

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/bootstrap.php');

class EmployeeCollectionAdapterTest extends \PHPUnit_Framework_TestCase
{
    const HREF = 'myfeed';
    
    /**
     * @var EmployeeCollectionAdapter
     */
    protected $adapter;
    
    /**
     * @var Aphera\Server\RequestContext
     */
    protected $request;
    
    protected $simpleEntryFilename;
    
    protected $provider;

    protected $aphera;

    protected $entryStream;
    
    public function setUp() {
        parent::setUp();

        $this->aphera = new Aphera();

        $this->adapter = new EmployeeCollectionAdapter();
        $this->adapter->setHref(self::HREF);
        
        $this->provider = $this->getMock('\\Aphera\\Server\\Provider');
        $this->provider->expects($this->any())
                       ->method('getAphera')
                       ->will($this->returnValue($this->aphera));

        $this->entryStream = \fopen(\dirname(__FILE__) . '/_files/simpleEntry.xml', 'r');
    }

    public function  tearDown() {
        parent::tearDown();
        \fclose($this->entryStream);
    }

    public function testPostEntry_EmptyAdapter_X() {
        $request = $this->makeRequest($this->entryStream);
        $response = $this->adapter->postEntry($request);
        $this->assertEquals(201, $response->getStatus());
    }

    /**
     * @todo should fseek be done by the parser?
     */
    public function testPostEntry_DoublePost_Returns400Response() {
        $this->markTestIncomplete('postentry does not check for duplicates');
        $request = $this->makeRequest($this->entryStream);
        $this->adapter->postEntry($request);
        \rewind($this->entryStream);
        $response = $this->adapter->postEntry($request);
        $this->assertEquals(400, $response->getStatus());
    }
    
    protected function makeEmptyRequest() {
        return new DefaultRequestContext($this->provider, 'GET', '', '');
    }
    
    protected function makeRequest($stream) {
        return new StreamRequestContext($stream, $this->provider, 'GET', '', '');
    }
}