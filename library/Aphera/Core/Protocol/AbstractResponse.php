<?php
namespace Aphera\Core\Protocol;

abstract class AbstractResponse extends AbstractMessage implements Response
{
    public function getAllow() {
        return $this->getHeader('Allow');
    }
    
    public function getType() {
        $status = $this->getStatus();
        if($status >= 200 && $status < 300) {
            return Response::TYPE_SUCCESS;
        } else if($status >= 300 && $status < 400) {
            return Response::TYPE_REDIRECT;
        } else if($status >= 400 && $status < 500) {
            return Response::TYPE_CLIENT_ERROR;
        } else if($status >= 500 && $status < 600) {
            return Response::TYPE_SERVER_ERROR;
        }
        return Response::TYPE_UNKNOWN;
    }
}