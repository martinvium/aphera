<?php
namespace Aphera\Server\Context;

use Aphera\Core\Protocol\Response;

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/bootstrap.php');

class EmptyResponseContextTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var EmptyResponseContext
     */
    protected $response;
    
    public function setUp() {
        parent::setUp();
        $this->response = new EmptyResponseContext();
    }
    
    public function testGetAllow_ViaSetHeader_ReturnsAllow() {
        $this->response->setHeader('Allow', 'POST');
        $this->assertEquals('POST', $this->response->getAllow());
    }
    
    public function testSetAllow_StringGETMethod_ReturnsStringGET() {
        $this->response->setAllow('GET');
        $this->assertEquals('GET', $this->response->getAllow());
    }
    
    public function testSetAllow_ArrayOfMethods_StringAllMethodsImploded() {
        $this->response->setAllow(array('GET','POST','HEAD'));
        $this->assertEquals('GET, POST, HEAD', $this->response->getAllow());
    }
    
    public function testGetStatus_DefaultValue_ReturnsZero() {
        $this->assertEquals(0, $this->response->getStatus());
    }
    
    public function testGetStatus_StatusChanged_ReturnsNewStatus() {
        $this->response->setStatus(200);
        $this->assertEquals(200, $this->response->getStatus());
    }
    
    public function testGetType_DefaultType_ReturnsUnknown() {
        $this->assertEquals(Response::TYPE_UNKNOWN, $this->response->getType());
    }
    
    public function testGetType_Status200_ReturnsSuccess() {
        $this->response->setStatus(200);
        $this->assertEquals(Response::TYPE_SUCCESS, $this->response->getType());
    }
    
    public function testGetType_Status299_ReturnsSuccess() {
        $this->response->setStatus(299);
        $this->assertEquals(Response::TYPE_SUCCESS, $this->response->getType());
    }
    
    public function testGetType_Status300_ReturnsSuccess() {
        $this->response->setStatus(300);
        $this->assertEquals(Response::TYPE_REDIRECT, $this->response->getType());
    }
    
    public function testGetType_Status399_ReturnsSuccess() {
        $this->response->setStatus(399);
        $this->assertEquals(Response::TYPE_REDIRECT, $this->response->getType());
    }
    
    public function testGetType_Status400_ReturnsSuccess() {
        $this->response->setStatus(400);
        $this->assertEquals(Response::TYPE_CLIENT_ERROR, $this->response->getType());
    }
    
    public function testGetType_Status499_ReturnsSuccess() {
        $this->response->setStatus(499);
        $this->assertEquals(Response::TYPE_CLIENT_ERROR, $this->response->getType());
    }
    
    public function testGetType_Status500_ReturnsSuccess() {
        $this->response->setStatus(500);
        $this->assertEquals(Response::TYPE_SERVER_ERROR, $this->response->getType());
    }
    
    public function testGetType_Status599_ReturnsSuccess() {
        $this->response->setStatus(599);
        $this->assertEquals(Response::TYPE_SERVER_ERROR, $this->response->getType());
    }
    
    public function testGetStatusText_DefaultValue_ReturnsEmptyString() {
        $this->assertEquals('', $this->response->getStatusText());
    }
    
    public function testGetStatusText_TextChanged_ReturnsNewText() {
        $this->response->setStatusText('testtext');
        $this->assertEquals('testtext', $this->response->getStatusText());
    }
    
    public function testSetHeader_AlreadyExists_OverwritesHeader() {
        $this->response->addHeader('testheader', 'testvalue');
        $this->response->setHeader('testheader', 'testvalue');
        $headers = $this->response->getHeaders('testheader');
        $this->assertEquals(array('testvalue'), $headers);
    }
    
    public function testSetHeader_ArrayValue_SetsAll() {
        $this->response->setHeader('testheader', array('testvalue', 'testvalue2'));
        $headers = $this->response->getHeaders('testheader');
        $this->assertEquals(array('testvalue', 'testvalue2'), $headers);
    }
    
    public function testAddHeader_MultipleHeaders_AllAdded() {
        $this->response->addHeader('testheader', 'testvalue');
        $this->response->addHeader('testheader', 'testvalue');
        $headers = $this->response->getHeaders('testheader');
        $this->assertEquals(array('testvalue', 'testvalue'), $headers);
    }
    
    public function testAddHeader_ArrayValue_SetsAll() {
        $this->response->setHeader('testheader', 'testvalue');
        $this->response->addHeader('testheader', array('testvalue2', 'testvalue3'));
        $headers = $this->response->getHeaders('testheader');
        $this->assertEquals(array('testvalue', 'testvalue2', 'testvalue3'), $headers);
    }
    
    public function testGetHeaders_WithNameDifferentHeadersExist_ReturnsOnlyWithName() {
        $this->response->addHeader('testheader', 'testvalue');
        $this->response->addHeader('testheader2', 'testvalue2');
        $this->response->addHeader('testheader3', 'testvalue3');
        $headers = $this->response->getHeaders('testheader2');
        $this->assertEquals(array('testvalue2'), $headers);
    }
    
    public function testGetHeader_MultipleHeaders_ReturnsOnlyFirst() {
        $this->response->addHeader('testheader', 'testvalue');
        $this->response->addHeader('testheader', 'testvalue2');
        $this->assertEquals('testvalue', $this->response->getHeader('testheader'));
    }
    
    public function testHasEntity_Always_ReturnsFalse() {
        $this->assertFalse($this->response->hasEntity());
    }
}