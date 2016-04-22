<?php

namespace Opteck\Responses;

use Opteck\Entities\TradeAction;
use Opteck\Response;

class GetTradeActions extends Response
{

    /**
     * @return \Opteck\Entities\TradeAction[]
     */
    public function getTradeActions()
    {
        $tradeActions = [];
        if (isset($this->data[static::FIELD_DATA])) {
            foreach ($this->data[static::FIELD_DATA] as $tradeActionData) {
                $tradeActions[] = new TradeAction($tradeActionData);
            }
        }

        return $tradeActions;
    }
}
