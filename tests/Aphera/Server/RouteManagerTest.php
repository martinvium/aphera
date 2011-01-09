<?php
namespace Aphera\Server;

use Aphera\Core\Protocol\Target;

require_once(dirname(dirname(dirname(__FILE__))) . '/bootstrap.php');

class RouteManagerTest extends \PHPUnit_Framework_TestCase
{
    const PATTERN_SERVICE = '/';
    const PATTERN_FEED = '/:feed/';
    const PATTERN_ENTRY = '/:feed/:entry/';

    /**
     * @var RouteManager
     */
    protected $manager;

    public function setUp() {
        parent::setUp();
        $this->manager = new RouteManager();
    }
    
    public function testResolve_ServiceUri_ReturnsServiceAction() {
        $this->changeManagerAddAllRoutes();
        $target = $this->manager->resolve($this->makeRequest('/'));
        $this->assertInstanceOf('\\Aphera\\Server\\RouteTarget', $target);
        $this->assertEquals(Target::TYPE_SERVICE, $target->getType());
        $this->assertEquals(array(), $target->getParameters());
    }

    public function testResolve_FeedUri_ReturnsFeedAction() {
        $this->changeManagerAddAllRoutes();
        $target = $this->manager->resolve($this->makeRequest('/hello'));
        $this->assertInstanceOf('\\Aphera\\Server\\RouteTarget', $target);
        $this->assertEquals(Target::TYPE_COLLECTION, $target->getType());
        $this->assertEquals(array('feed' => 'hello'), $target->getParameters());
    }

    public function testResolve_EntryUri_ReturnsEntryAction() {
        $this->changeManagerAddAllRoutes();
        $target = $this->manager->resolve($this->makeRequest('/hello/there'));
        $this->assertInstanceOf('\\Aphera\\Server\\RouteTarget', $target);
        $this->assertEquals(Target::TYPE_ENTRY, $target->getType());
        $this->assertEquals(array('feed' => 'hello', 'entry' => 'there'), $target->getParameters());
    }

    public function testResolve_UnknownUri_ReturnsEntryAction() {
        $this->changeManagerAddAllRoutes();
        $target = $this->manager->resolve($this->makeRequest('/hello/there/unknown'));
        $this->assertNull($target);
    }

    public function testAddSimpleRoute_MixedParams_ReturnsEntryAction() {
        $this->manager->addSimpleRoute('test', self::PATTERN_ENTRY, Target::TYPE_CATEGORIES);
        $target = $this->manager->resolve($this->makeRequest('/hello/there'));
        $this->assertInstanceOf('\\Aphera\\Server\\RouteTarget', $target);
        $this->assertEquals(Target::TYPE_CATEGORIES, $target->getType());
        $this->assertEquals(array('feed' => 'hello', 'entry' => 'there'), $target->getParameters());
    }

    protected function makeRequest($uri) {
        $request = $this->getMock('\\Aphera\\Server\\RequestContext');
        $request->expects($this->any())
                ->method('getTargetPath')
                ->will($this->returnValue($uri));
        return $request;
    }

    protected function changeManagerAddAllRoutes() {
        $this->manager->addRoute(new Route('service', self::PATTERN_SERVICE, Target::TYPE_SERVICE));
        $this->manager->addRoute(new Route('feed', self::PATTERN_FEED, Target::TYPE_COLLECTION));
        $this->manager->addRoute(new Route('entry', self::PATTERN_ENTRY, Target::TYPE_ENTRY));
    }
}