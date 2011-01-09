<?php
namespace Aphera\Server\Context;

use Aphera\Core\Protocol\Response;

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/bootstrap.php');

class BasicResponseContextTest extends \PHPUnit_Framework_TestCase
{
    protected $entry;
    
    /**
     * @var EmptyResponseContext
     */
    protected $response;
    
    public function setUp() {
        parent::setUp();
        
        $this->entry = $this->getMock('Aphera\\Model\\Entry');
        $this->response = new BasicResponseContext($this->entry);
    }
    
    public function testWriteTo_ViaSetHeader_ReturnsAllow() {
        $stream = fopen('php://memory', 'w');
        $writer = $this->getMock('Aphera\\Core\\Writer');
        $this->response->setWriter($writer);
        
        $writer->expects($this->once())
               ->method('writeTo')
               ->with($this->entry, $stream);
        
        $this->response->writeTo($stream);
    }
    
    public function testHasEntity_PassedViaConstructor_ReturnsTrue() {
        $this->assertTrue($this->response->hasEntity());
    }
    
    public function testGetEntity_PassedViaConstructor_ReturnsEntity() {
        $this->assertSame($this->entry, $this->response->getEntity());
    }
}