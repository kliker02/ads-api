<?php


namespace Kliker02\VcruTask\Database;


use Laminas\Db\Adapter\Adapter;
use Laminas\ServiceManager\ServiceManager;

class ConnectionFactory
{
    public function __invoke(ServiceManager $sm)
    {
        $config = $sm->get('ApplicationConfig');
        return $Connection = new Adapter($config['database']);
    }

}