<?php
namespace Aphera\Core\Protocol;

interface Resolver
{
    /**
     * @param Request $request
     * @return Route
     */
    public function resolve($request);
}