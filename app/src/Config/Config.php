<?php

namespace Kliker02\VcruTask\Config;

/**
 * @author Alex Tokunov
 * Class Config
 * @package Kliker02\VcruTask\Config
 */
class Config implements ConfigInterface
{
    protected $config = array();

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function getConfig() {
        return $this->config;
    }
}