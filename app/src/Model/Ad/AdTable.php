<?php

namespace Kliker02\VcruTask\Model\Ad;

use Laminas\Db\ResultSet\ResultSet;
use Laminas\Db\Sql\Select;
use Laminas\Db\TableGateway\TableGateway;
use Laminas\ServiceManager\ServiceManager;

/**
 * @author Alex Tokunov
 * Class AdTable
 * @package Kliker02\VcruTask\Model\Ad
 */
class AdTable extends TableGateway
{
    protected $table = 'ads';

    public function __construct(ServiceManager $sm) {
        $adapter = $sm->get('DbConnection');

        $resultSet = new ResultSet(null, new \ArrayObject(array(), \ArrayObject::ARRAY_AS_PROPS));
        parent::__construct($this->table, $adapter, null, $resultSet);
    }

    public function get($id) {
        return $this->select(static function (Select $select) use($id) {
            $select->where(['id'=>$id])->limit(1);
        })->current();
    }

    public function getRelevant() {
        return $this->select(static function (Select $select) {
            $select->where(new \Laminas\Db\Sql\Predicate\Expression('`Limit` > `Shown`'))
                ->order('Price DESC')
                ->limit(1);
        })->current();
    }
}