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
$apheraRoot = realpath(dirname(dirname(__FILE__)));
$apheraTests = $apheraRoot . '/tests';
$apheraLibrary = $apheraRoot . '/library';

$path = array(
    $apheraLibrary,
    $apheraTests,
    get_include_path()
);

set_include_path(implode(PATH_SEPARATOR, $path));

require_once($apheraLibrary . '/Aphera/Core/Loader.php');
Aphera\Core\Loader::registerAutoload();

require_once('PHPUnit/Framework/TestCase.php');