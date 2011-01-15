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
namespace Aphera\Server\Processor;

use Aphera\Server\RequestProcessor;

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/bootstrap.php');

class EntryRequestProcessorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var RequestProcessor
     */
    protected $processor;
    
    protected $adapter;
    
    public function setUp() {
        parent::setUp();
        
        $this->processor = new EntryRequestProcessor();
        $this->adapter = $this->getMock('\\Aphera\\Server\\CollectionAdapter');
    }
    
    public function testProcess_PostRequest_CallsAdapterWithRequest() {
        $request = $this->makeRequest('POST');
        
        $this->adapter->expects($this->once())
                      ->method('postEntry')
                      ->with($request);
        
        $this->processor->process($request, $this->adapter);
    }
    
    public function testProcess_GetRequest_CallsAdapterWithRequest() {
        $request = $this->makeRequest('GET');
        
        $this->adapter->expects($this->once())
                      ->method('getEntry')
                      ->with($request);
        
        $this->processor->process($request, $this->adapter);
    }
    
    public function testProcess_PutRequest_CallsAdapterWithRequest() {
        $request = $this->makeRequest('PUT');
        
        $this->adapter->expects($this->once())
                      ->method('putEntry')
                      ->with($request);
        
        $this->processor->process($request, $this->adapter);
    }
    
    public function testProcess_DeleteRequest_CallsAdapterWithRequest() {
        $request = $this->makeRequest('DELETE');
        
        $this->adapter->expects($this->once())
                      ->method('deleteEntry')
                      ->with($request);
        
        $this->processor->process($request, $this->adapter);
    }
    
    public function testProcess_HeadRequest_CallsAdapterWithRequest() {
        $request = $this->makeRequest('HEAD');
        
        $this->adapter->expects($this->once())
                      ->method('headEntry')
                      ->with($request);
        
        $this->processor->process($request, $this->adapter);
    }
    
    public function testProcess_OptionsRequest_CallsAdapterWithRequest() {
        $request = $this->makeRequest('OPTIONS');
        
        $this->adapter->expects($this->once())
                      ->method('optionsEntry')
                      ->with($request);
        
        $this->processor->process($request, $this->adapter);
    }
    
    protected function makeRequest($method) {
        $request = $this->getMock('\\Aphera\\Server\\RequestContext');
        $request->expects($this->any())
                ->method('getMethod')
                ->will($this->returnValue($method));
        return $request;
    }
}