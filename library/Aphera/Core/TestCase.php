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
namespace Aphera\Core;

use Aphera\Server\ResponseContext;

class TestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Aphera
     */
    protected $aphera;

    public function setUp() {
        parent::setUp();
        $this->aphera = new Aphera();
    }

    protected function assertResponseContains($expectedString, ResponseContext $response) {
        $outStream = $this->makeMemoryStream();
        $response->writeTo($outStream, $this->aphera->getWriter());
        \rewind($outStream);
        $out = \stream_get_contents($outStream);
        $this->assertContains($expectedString, $out);
    }

    protected function makeMemoryStream() {
        return fopen('php://memory', 'w');
    }
}