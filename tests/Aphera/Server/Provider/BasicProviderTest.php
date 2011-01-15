<?php
namespace Aphera\Server\Provider;

use Aphera\Server\Provider\BasicProvider;
use Aphera\Server\Context\DefaultRequestContext;
use Aphera\Core\Aphera;

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/bootstrap.php');

class BasicProviderTest extends \PHPUnit_Framework_TestCase
{
    const BASE_URI = 'http://www.example.com/api';

    /**
     * @var BasicProvider
     */
    protected $provider;

    protected $manager;
    
    public function setUp() {
        parent::setUp();
        
        $this->provider = new BasicProvider();
//        $this->provider->init(new Aphera());
        $this->manager = $this->getMock('\\Aphera\\Server\\WorkspaceManager');
        $this->provider->setWorkspaceManager($this->manager);
    }

    public function testProcess_HelloFeedUri_ReturnsHelloAdapter() {
        $request = $this->makeRequest('POST', self::BASE_URI . '/hello');
        $adapter = $this->getMock('\\Aphera\\Server\\CollectionAdapter');
        $this->manager->expects($this->any())
                      ->method('getCollectionAdapter')
                      ->will($this->returnValue($adapter));

        $adapter->expects($this->once())
                ->method('postEntry')
                ->with($request);

        $this->provider->process($request);
    }

    protected function makeRequest($method, $uri) {
        return new DefaultRequestContext($this->provider, $method, $uri, self::BASE_URI);
    }
}