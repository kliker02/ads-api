<?php


namespace Kliker02\VcruTask\Model\Ad;

use Kliker02\VcruTask\Model\ExchangableInterface;

class View implements ExchangableInterface
{
    /**
     * @var int
     */
    private $ID;

    /**
     * @var int
     */
    private $Ad_ID;

    /**
     * @var int
     */
    private $Price;



    public function __construct($data = array())
    {
    }

    public function toArray()
    {
        // TODO: Implement toArray() method.
    }

    /**
     * @return int
     */
    public function getPrice()
    {
        return $this->Price;
    }

    /**
     * @param int $Price
     */
    public function setPrice($Price)
    {
        $this->Price = $Price;
    }

    /**
     * @return int
     */
    public function getAdID()
    {
        return $this->Ad_ID;
    }

    /**
     * @param int $Ad_ID
     */
    public function setAdID($Ad_ID)
    {
        $this->Ad_ID = $Ad_ID;
    }

    /**
     * @return int
     */
    public function getID()
    {
        return $this->ID;
    }

    /**
     * @param int $ID
     */
    public function setID($ID)
    {
        $this->ID = $ID;
    }
}