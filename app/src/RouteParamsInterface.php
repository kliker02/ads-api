<?php


namespace Kliker02\VcruTask;


interface RouteParamsInterface
{
    public function getParam($name, $default = '');
}