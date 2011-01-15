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