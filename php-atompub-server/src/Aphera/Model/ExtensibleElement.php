<?php
namespace Aphera\Model;

interface ExtensibleElement extends Element
{
    public function getFirstChildByTagName($name, $uri);
}