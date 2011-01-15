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
namespace Aphera\Server\Context;

use Aphera\Core\Protocol\Response;

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/bootstrap.php');

class DefaultRequestContextTest extends \PHPUnit_Framework_TestCase
{
    const URI = 'http://www.example.org/atom/resource/123';
    const BASE_URI = 'http://www.example.org/atom';
    
    protected $provider;
    
    protected $stream;
    
    public function setUp() {
        parent::setUp();
        $this->provider = $this->getMock('\\Aphera\\Server\\Provider');
        $this->stream = fopen('php://memory', 'r');
    }
    
    public function testGetMethod_PostRequest_ReturnsPost() {
        $request = $this->makeRequest('POST');
        $this->assertEquals('POST', $request->getMethod());
    }
    
    public function testGetMethod_GetRequest_ReturnsGet() {
        $request = $this->makeRequest('GET');
        $this->assertEquals('GET', $request->getMethod());
    }
    
    public function testGetUri_Scenario_ReturnsUri() {
        $request = $this->makeRequest('GET');
        $this->assertEquals(self::URI, $request->getUri());
    }
    
    public function testGetBaseUri_Scenario_ReturnsBaseUri() {
        $request = $this->makeRequest('GET');
        $this->assertEquals(self::BASE_URI, $request->getBaseUri());
    }
    
    public function testGetDocument_MockParser_CallsParserParseStream() {
        $request = $this->makeRequest('GET');
        $parser = $this->getMock('\\Aphera\\Core\\Parser');
        $doc = $this->getMock('\\Aphera\\Model\\Document');
        
        $parser->expects($this->once())
               ->method('parseStream')
               ->with($this->stream)
               ->will($this->returnValue($doc));
        
        $actual = $request->getDocument($parser);
        $this->assertSame($doc, $actual);
    }
    
    public function testGetInputStream_StubbedStream_ReturnsStream() {
        $request = $this->makeRequest('GET');
        $stream = $request->getInputStream();
        $this->assertSame($this->stream, $stream);
    }
    
    public function testGetTargetType_Scenario_Assertions() {
        $this->markTestIncomplete('todo');
        $request = $this->makeRequest('GET');
        $type = $request->getTargetType();
        $this->assertEquals('', $type);
    }
    
    protected function changeRequestSetHeader($name, $value) {
        $_SERVER[$name] = $value;
    }
    
    /**
     * @param string $method
     * @return TestAsset\StubRequestContext 
     */
    protected function makeRequest($method) {
        $request = new TestAsset\StubRequestContext($this->provider, $method, self::URI, self::BASE_URI);
        $request->setTestStream($this->stream);
        return $request;
    }
}