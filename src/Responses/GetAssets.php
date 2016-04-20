<?php

namespace Opteck\Responses;

use Opteck\Entities\Asset;
use Opteck\Response;

class GetAssets extends Response
{
    /**
     * @return \Opteck\Entities\Asset[]
     */
    public function getAssets()
    {
        $assets = [];
        if (isset($this->data[static::FIELD_DATA])) {
            foreach ($this->data[static::FIELD_DATA] as $assetData) {
                $assets[] = new Asset($assetData);
            }
        }

        return $assets;
    }
}
