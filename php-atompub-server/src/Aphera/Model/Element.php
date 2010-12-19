<?php
namespace Aphera\Model;

interface Element extends Base
{
    public function getTagName();
    
    public function getValue();
}