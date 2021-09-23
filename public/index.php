<?php
chdir(__DIR__.'/../');

include __DIR__ . '/../vendor/autoload.php';

$arrConfig = require __DIR__ . '/../config/config.php';
$Config = new \Kliker02\VcruTask\Config\Config($arrConfig);

$Application = new \Kliker02\VcruTask\Application();
$Application->init($Config)->run();
