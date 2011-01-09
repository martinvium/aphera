<?php
namespace Aphera\Server\Adapter;

use Aphera\Server\ResponseContext;
use Aphera\Core\Aphera;
use Aphera\Server\Context\DefaultRequestContext;

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/bootstrap.php');

/**
 * @group disable
 */
class AbstractEntityCollectionAdapterTest extends \PHPUnit_Framework_TestCase
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
        
        $this->adapter = new TestAsset\StubEntityCollectionAdapter();
        $this->adapter->setHref(self::HREF);
    }
    
    public function testHeadEntry_Scenario_Assertions() {
        $response = $this->adapter->headEntry($this->request);
    }
}