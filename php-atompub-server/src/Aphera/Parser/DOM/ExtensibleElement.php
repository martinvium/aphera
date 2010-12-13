<?php
namespace Aphera\Parser\DOM;

use Aphera\Model;

class ExtensibleElement extends Element implements Model\ExtensibleElement
{
    public function __construct ($name, $value, $uri) {
        parent::__construct($name, $value, $uri);
    }
}