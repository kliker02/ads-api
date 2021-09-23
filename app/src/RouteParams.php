<?php


namespace Kliker02\VcruTask;

/**
 * @author Alex Tokunov
 * Class RouteParams
 * @package Kliker02\VcruTask
 */
class RouteParams implements RouteParamsInterface
{
    protected $params;

    public function __construct(array $params)
    {
        $this->params = $params;
    }

    public function getParam($name, $default = '') {
        if (!isset($this->params[$name])) {
            return$default;
        }

        return $this->params[$name];
    }

}