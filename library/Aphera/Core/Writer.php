<?php
namespace Aphera\Core;

use Aphera\Model\ExtensibleElement;

interface Writer
{
    public function writeTo(ExtensibleElement $element, $stream);
}