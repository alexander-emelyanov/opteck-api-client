<?php

namespace Opteck\Responses;

use Opteck\Entities\Market;
use Opteck\Response;

class GetMarkets extends Response
{
    /**
     * @return \Opteck\Entities\Market[]
     */
    public function getMarkets()
    {
        $markets = [];
        if (isset($this->data[static::FIELD_DATA])) {
            foreach ($this->data[static::FIELD_DATA] as $marketData) {
                $markets[] = new Market($marketData);
            }
        }

        return $markets;
    }
}
