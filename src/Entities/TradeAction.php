<?php

namespace Opteck\Entities;

use Opteck\Entity;

class TradeAction extends Entity
{
    const STATUS_IN_PROGRESS = 1;

    const STATUS_CALCULATING = 2;

    const STATUS_CLOSED = 3;

    const STATUS_SOLD = 4;

    const STATUS_CANCELED = 5;

    /**
     * Returns Trade action ID.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns Option Type ID of trade.
     *
     * @return int
     */
    public function getOptionTypeId()
    {
        return $this->optionTypeID;
    }

    /**
     * Returns Asset ID of trade.
     *
     * @return int
     */
    public function getAssetId()
    {
        return $this->assetID;
    }

    /**
     * Returns asset name.
     *
     * @return string
     */
    public function getAssetName()
    {
        return $this->assetName;
    }

    /**
     * Returns Definition ID of trade.
     *
     * @return int
     */
    public function getDefinitionId()
    {
        return $this->definitionID;
    }

    /**
     * Returns trade action created UNIX timestamp.
     *
     * @return int
     */
    public function getCreatedDate()
    {
        return strtotime($this->createdDate);
    }

    /**
     * Returns trade action expiration UNIX timestamp.
     *
     * @return int
     */
    public function getExpirationDate()
    {
        return strtotime($this->expirationDate);
    }

    /**
     * Returns trade currency in ISO 4217, e.g. 'USD'.
     *
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Returns trade status.
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    public function getStatusText()
    {
        return $this->getStatusTextByValue($this->getStatus());
    }

    /**
     * Returns direction of the trade. 1 - Up, -1 - Down.
     *
     * @return int
     */
    public function getDirection()
    {
        return $this->direction;
    }

    /**
     * Returns trade amount in USD.
     *
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Returns trade amount in original currency.
     *
     * @return float
     */
    public function getAmountLead()
    {
        return $this->amountLead;
    }

    /**
     * Returns trade profit in USD. If trade isn’t closed - 0.
     *
     * @return float
     */
    public function getProfit()
    {
        return $this->profit;
    }

    /**
     * Returns trade profit in original currency. If trade isn’t closed - 0.
     *
     * @return float
     */
    public function getProfitLead()
    {
        return $this->profitLead;
    }

    /**
     * Returns trade strike (asset price at the moment of the trade).
     *
     * @return float
     */
    public function getStrike()
    {
        return $this->strike;
    }

    /**
     * Returns trade expiration strike (asset price at the moment of the trade expiration).
     *
     * @return float
     */
    public function getStrikeEnd()
    {
        return $this->strikeEnd;
    }

    protected $id;

    protected $optionTypeID;

    protected $assetID;

    protected $assetName;

    protected $definitionID;

    protected $createdDate;

    protected $expirationDate;

    protected $currency;

    protected $status;

    protected $direction;

    protected $amount;

    protected $amountLead;

    protected $profit;

    protected $profitLead;

    protected $strike;

    protected $strikeEnd;

    public static function getStatusesDict()
    {
        return [
            static::STATUS_IN_PROGRESS => 'In progress',
            static::STATUS_CALCULATING => 'Calculation',
            static::STATUS_CLOSED      => 'Closed',
            static::STATUS_SOLD        => 'Sold',
            static::STATUS_CANCELED    => 'Canceled',
        ];
    }

    private static function getStatusTextByValue($status)
    {
        $statusesDict = static::getStatusesDict();
        if (isset($statusesDict[$status])) {
            return $statusesDict[$status];
        }

        return 'Unknown';
    }
}
