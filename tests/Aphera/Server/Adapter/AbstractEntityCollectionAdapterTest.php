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