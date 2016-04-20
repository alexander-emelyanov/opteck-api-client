<?php

namespace Opteck\Responses;

use Opteck\Exceptions\TooSmallAmountException;
use Opteck\Response;

class Trade extends Response
{
    const RETURN_CODE_TOO_SMALL_AMOUNT = 105;

    const FIELD_TRADE_ACTION_ID = 'tradeActionID';

    const FIELD_BALANCE = 'balance';

    protected function check()
    {
        if ($this->getReturnCode() == static::RETURN_CODE_TOO_SMALL_AMOUNT) {
            throw new TooSmallAmountException($this, 'Too small amount');
        }
    }

    /**
     * Returns ID of created trade action.
     *
     * @return int
     */
    public function getTradeActionId()
    {
        return intval($this->data[static::FIELD_DATA][static::FIELD_TRADE_ACTION_ID]);
    }

    /**
     * Returns lead balance after trade action in original currency.
     *
     * @return float
     */
    public function getBalance()
    {
        return floatval($this->data[static::FIELD_DATA][static::FIELD_BALANCE]);
    }
}
