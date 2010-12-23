<?php
namespace Aphera\Core\Protocol;

interface Request extends Message
{
    public function getAccept();
}