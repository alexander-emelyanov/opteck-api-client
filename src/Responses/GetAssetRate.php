<?php

namespace Opteck\Responses;

use Opteck\Response;

class GetAssetRate extends Response
{
    const FIELD_RATE = 'rate';

    const FIELD_TIMESTAMP = 'timestamp';

    const FIELD_MICROTIME = 'microtime';

    /**
     * Returns current asset rate.
     *
     * @return float
     */
    public function getRate()
    {
        return $this->data[static::FIELD_DATA][static::FIELD_RATE];
    }

    /**
     * Returns the UNIX of asset rate.
     *
     * @return string
     */
    public function getTimestamp()
    {
        return $this->data[static::FIELD_DATA][static::FIELD_TIMESTAMP];
    }

    /**
     * Returns the UNIX of asset rate.
     *
     * @return string
     */
    public function getMicrotime()
    {
        return $this->data[static::FIELD_DATA][static::FIELD_MICROTIME];
    }
}
