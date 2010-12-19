<?php
$apheraRoot = realpath(dirname(dirname(__FILE__)));
$apheraTests = $apheraRoot . '/tests';
$apheraLibrary = $apheraRoot . '/src';

$path = array(
    $apheraLibrary,
    $apheraTests,
    get_include_path()
);

set_include_path(implode(PATH_SEPARATOR, $path));

require_once($apheraLibrary . '/Aphera/Core/Loader.php');
Aphera\Core\Loader::registerAutoload();

require_once('PHPUnit/Framework/TestCase.php');