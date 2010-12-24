<?php
namespace Aphera\Server\Processor;

use Aphera\Server\RequestProcessor;

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/bootstrap.php');

class CollectionRequestProcessorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var RequestProcessor
     */
    protected $processor;
    
    protected $adapter;
    
    public function setUp() {
        parent::setUp();
        
        $this->processor = new CollectionRequestProcessor();
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
                      ->method('getFeed')
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