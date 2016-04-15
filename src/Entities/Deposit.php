<?php

namespace Opteck\Entities;

use Opteck\Entity;

class Deposit extends Entity
{
    /**
     * @return int
     */
    public function getLeadId()
    {
        return intval($this->leadID);
    }

    /**
     * Returns UNIX timestamp when deposit was created.
     *
     * @return int
     */
    public function getDateDeposited()
    {
        return strtotime($this->dateDeposited);
    }

    /**
     * Returns currency code in ISO 4217, e.g. 'USD'.
     *
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @return float
     */
    public function getAmount()
    {
        return floatval($this->amount);
    }

    /**
     * @return float
     */
    public function getAmountUSD()
    {
        return floatval($this->amountUSD);
    }

    /**
     * @return bool
     */
    public function getIsFirstTimeDeposit()
    {
        return boolval($this->isFirstTimeDeposit);
    }

    /**
     * @return bool
     */
    public function getIsValid()
    {
        return boolval($this->isValid);
    }

    /**
     * @var int
     */
    protected $leadID;

    /**
     * Example: '2016-04-11T12:53:59+00:00'.
     *
     * @var string
     */
    protected $dateDeposited;

    /**
     * Currency code in ISO 4217, e.g. 'USD'.
     *
     * @var string
     */
    protected $currency;

    /**
     * @var float
     */
    protected $amount;

    /**
     * @var float
     */
    protected $amountUSD;

    /**
     * @var int
     */
    protected $isFirstTimeDeposit;

    /**
     * @var int
     */
    protected $isValid;
}
