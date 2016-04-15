<?php

namespace Opteck\Responses;

use Opteck\Entities\Deposit;
use Opteck\Response;

class GetDeposits extends Response
{
    const FIELD_DEPOSITS = 'deposits';

    /**
     * @return \Opteck\Entities\Deposit[]
     */
    public function getDeposits()
    {
        $deposits = [];
        if (isset($this->data[static::FIELD_DATA][static::FIELD_DEPOSITS])){
            foreach ($this->data[static::FIELD_DATA][static::FIELD_DEPOSITS] as $depositData) {
                $deposits[] = new Deposit($depositData);
            }
        }
        return $deposits;
    }
}
