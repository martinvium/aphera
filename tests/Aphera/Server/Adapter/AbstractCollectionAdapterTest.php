<?php
namespace Aphera\Server\Adapter;

use Aphera\Server\ResponseContext;
use Aphera\Core\Aphera;
use Aphera\Server\Context\DefaultRequestContext;

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/bootstrap.php');

/**
 * @group disable
 */
class AbstractCollectionAdapterTest extends \PHPUnit_Framework_TestCase
{
    const HREF = 'myfeed';
    
    /**
     * @var AbstractCollectionAdapter
     */
    protected $adapter;
    
    /**
     * @var Aphera\Server\RequestContext
     */
    protected $request;
    
    public function setUp() {
        parent::setUp();
        
        $this->request = new DefaultRequestContext($this->getMock('\\Aphera\\Server\\Provider'), 'GET', '', '');
        
        $this->adapter = new TestAsset\StubCollectionAdapter();
        $this->adapter->setHref(self::HREF);
    }
    
    public function testGetHref_PostRequest_ReturnsPost() {
        $this->assertEquals(self::HREF, $this->adapter->getHref($this->request));
    }
    
    public function testGetEntry_DefaultAction_ReturnsNotAllowedRespone() {
        $response = $this->adapter->getEntry($this->request);
        $this->assertNotAllowed($response);
    }
    
    public function testPostEntry_DefaultAction_ReturnsNotAllowedRespone() {
        $response = $this->adapter->postEntry($this->request);
        $this->assertNotAllowed($response);
    }
    
    public function testPutEntry_DefaultAction_ReturnsNotAllowedRespone() {
        $response = $this->adapter->putEntry($this->request);
        $this->assertNotAllowed($response);
    }
    
    public function testDeleteEntry_DefaultAction_ReturnsNotAllowedRespone() {
        $response = $this->adapter->deleteEntry($this->request);
        $this->assertNotAllowed($response);
    }
    
    public function testOptionsEntry_DefaultAction_ReturnsNotAllowedRespone() {
        $response = $this->adapter->optionsEntry($this->request);
        $this->assertNotAllowed($response);
    }
    
    public function testHeadEntry_DefaultAction_ReturnsNotAllowedRespone() {
        $response = $this->adapter->headEntry($this->request);
        $this->assertNotAllowed($response);
    }
    
    public function testGetAccepts_Scenario_ReturnsAtomEntrytType() {
        $type = $this->adapter->getAccepts($this->request);
        $this->assertEquals("application/atom+xml;type=entry", $type);
    }
    
    protected function assertNotAllowed(ResponseContext $response) {
        $this->assertEquals(405, $response->getStatus());
        $this->assertEquals('Method Not Allowed', $response->getStatusText());
    }
}