<?php
namespace Aphera\Server\Provider;

use Aphera\Server\Provider\BasicProvider;
use Aphera\Server\Context\DefaultRequestContext;

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/bootstrap.php');

class BasicProviderTest extends \PHPUnit_Framework_TestCase
{
    const BASE_URI = 'http://www.example.com/api';

    /**
     * @var BasicProvider
     */
    protected $provider;
    
    public function setUp() {
        parent::setUp();
        
        $this->provider = new BasicProvider();
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testGetCollectionAdapter_EmptyUri_ThrowsInvalidArgumentException() {
        $adapter = $this->getMockForAbstractClass('\\Aphera\\Server\\Adapter\\AbstractEntityCollectionAdapter');
        $this->provider->registerCollectionAdapter('hello', get_class($adapter));

        $returnedAdapter = $this->provider->getCollectionAdapter($this->makeRequest('POST', ''));
        $this->assertEquals(get_class($adapter), $returnedAdapter);
    }

    public function testGetCollectionAdapter_HelloFeedUri_ReturnsHelloAdapter() {
        $adapter = $this->getMockForAbstractClass('\\Aphera\\Server\\Adapter\\AbstractEntityCollectionAdapter');
        $this->provider->registerCollectionAdapter('hello', get_class($adapter));

        $returnedAdapter = $this->provider->getCollectionAdapter($this->makeRequest('POST', self::BASE_URI . '/hello'));
        $this->assertEquals(get_class($adapter), get_class($returnedAdapter));
    }

    public function testProcess_HelloFeedUri_ReturnsHelloAdapter() {
        $this->markTestIncomplete('implement workspace manager so we can mock getCollectionAdapter');

        $request = $this->makeRequest('POST', self::BASE_URI . '/hello');
        $adapter = $this->getMockForAbstractClass('\\Aphera\\Server\\Adapter\\AbstractEntityCollectionAdapter');
        $this->provider->registerCollectionAdapter('hello', get_class($adapter));

        $adapter->expects($this->once())
                ->method('postEntry')
                ->with($request);

        $this->provider->process($request);
    }

    protected function makeRequest($method, $uri) {
        return new DefaultRequestContext($this->provider, $method, $uri, self::BASE_URI);
    }
}