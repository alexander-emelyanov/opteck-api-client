<?php

namespace Opteck\Entities;

use Opteck\Entity;

class Asset extends Entity
{
    /**
     * Returns Asset ID.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns Asset name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Returns asset precision ­ the count numbers after comma (1..6).
     *
     * @return int
     */
    public function getPrecision()
    {
        return $this->precision;
    }

    /**
     * Returns Market ID of the asset.
     *
     * @return mixed
     */
    public function getMarketId()
    {
        return $this->marketID;
    }

    /**
     * Returns the date when asset will be opened (only if isActive = 0).
     *
     * @return mixed
     */
    public function getNextOpenTime()
    {
        return $this->nextOpenTime;
    }

    /**
     * Returns status of the asset (1 ­ enabled, 0 ­ disabled).
     *
     * @return bool
     */
    public function isActive()
    {
        return boolval(intval($this->isActive));
    }

    protected $id;

    protected $name;

    protected $precision;

    protected $marketID;

    protected $nextOpenTime;

    protected $isActive;
}
