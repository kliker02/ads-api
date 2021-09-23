<?php


namespace Kliker02\VcruTask\Model;

/**
 * @author Alex Tokunov
 * Class Ad
 * @package Kliker02\VcruTask\Model
 */
class Ad implements ExchangableInterface
{
    /**
     * @var int
     */
    private $ID;

    /**
     * @var string
     */
    private $Text;

    /**
     * @var float
     */
    private $Price;

    /**
     * @var int
     */
    private $Limit;

    /**
     * @var int
     */
    private $Shown;

    /**
     * @var string
     */
    private $Banner;

    public function __construct($data = array())
    {
    }

    /**
     * @param int
     */
    public function setID($ID)
    {
        $this->ID = $ID;
    }

    /**
     * @return int
     */
    public function getID()
    {
        return $this->ID;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->Text;
    }

    /**
     * @param string $Text
     */
    public function setText($Text)
    {
        $this->Text = $Text;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->Price;
    }

    /**
     * @param float $Price
     */
    public function setPrice($Price)
    {
        $this->Price = $Price;
    }

    /**
     * @return int
     */
    public function getLimit()
    {
        return $this->Limit;
    }

    /**
     * @param int $Limit
     */
    public function setLimit($Limit)
    {
        $this->Limit = $Limit;
    }

    /**
     * @return string
     */
    public function getBanner()
    {
        return $this->Banner;
    }

    /**
     * @param string $Banner
     */
    public function setBanner($Banner)
    {
        $this->Banner = $Banner;
    }

    public function toArray()
    {
    }

    /**
     * @return int
     */
    public function getShown()
    {
        return $this->Shown;
    }

    /**
     * @param int $Shown
     */
    public function setShown($Shown)
    {
        $this->Shown = $Shown;
    }
}