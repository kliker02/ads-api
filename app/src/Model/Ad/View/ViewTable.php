<?php


namespace Kliker02\VcruTask\Model\Ad\View;

use Laminas\Db\ResultSet\ResultSet;
use Laminas\Db\TableGateway\TableGateway;
use Laminas\ServiceManager\ServiceManager;

/**
 * @author Alex Tokunov
 * Class ViewTable
 * @package Kliker02\VcruTask\Model\Ad\View
 */
class ViewTable extends TableGateway
{
    protected $table = 'ads_views';

    public function __construct(ServiceManager $sm) {
        $adapter = $sm->get('DbConnection');

        $resultSet = new ResultSet(null, new \ArrayObject(array(), \ArrayObject::ARRAY_AS_PROPS));
        parent::__construct($this->table, $adapter, null, $resultSet);
    }
}