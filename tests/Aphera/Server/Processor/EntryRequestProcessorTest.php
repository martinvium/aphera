<?php
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