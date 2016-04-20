<?php

namespace Opteck\Entities;

use Opteck\Entity;

class Definition extends Entity
{
    /**
     * Returns Definition ID.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns Asset ID of the definition.
     *
     * @return int
     */
    public function getAssetId()
    {
        return $this->assetID;
    }

    /**
     * Returns Asset Name of the definition.
     *
     * @return string
     */
    public function getAssetName()
    {
        return $this->assetName;
    }

    /**
     * Returns Market ID of the definition.
     *
     * @return int
     */
    public function getMarketId()
    {
        return $this->marketID;
    }

    /**
     * Returns Option Type ID of the definition.
     *
     * @return int
     */
    public function getOptionTypeId()
    {
        return $this->optionTypeID;
    }

    /**
     * Returns duration of the definition. In seconds.
     *
     * @return int
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Returns the number of seconds before the end of the definition, during which you can not sell a trade.
     *
     * @return int
     */
    public function getStopTime()
    {
        return intval($this->stopTime);
    }

    /**
     * Returns definition payout. In percentages.
     *
     * @return int
     */
    public function getPayout()
    {
        return $this->payout;
    }

    /**
     * Returns protection payout. In percentages.
     *
     * @return int
     */
    public function getProtection()
    {
        return $this->protection;
    }

    /**
     * Returns the number of seconds after the start of the definition, during which you can not sell a trade.
     *
     * @return int
     */
    public function getSellStopTime()
    {
        return $this->sellStopTime;
    }

    /**
     * Returns UNIX timestamp when definition starts.
     *
     * @return int
     */
    public function getStartTime()
    {
        return strtotime($this->startTime);
    }

    /**
     * Returns UNIX timestamp when definition ends.
     *
     * @return int
     */
    public function getEndTime()
    {
        return strtotime($this->endTime);
    }

    /**
     * @return bool
     */
    public function getIsActive()
    {
        return boolval(intval($this->isActive));
    }

    protected $id;

    protected $assetID;

    protected $assetName;

    protected $marketID;

    protected $optionTypeID;

    protected $duration;

    protected $stopTime;

    protected $payout;

    protected $protection;

    protected $sellStopTime;

    protected $startTime;

    protected $endTime;

    protected $isActive;
}
