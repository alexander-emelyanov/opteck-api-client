<?php

namespace Opteck\Requests;

use Opteck\Request;

class Trade extends Request
{
    /**
     * Returns token from Authentication method.
     *
     * @see \Opteck\ApiClient::auth()
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Returns timestamp of the asset rate which you got from Asset Rate method.
     *
     * @see \Opteck\ApiClient::getAssetRate()
     *
     * @return string
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * Returns microtime of the asset rate which you got from Asset Rate method.
     *
     * @see \Opteck\ApiClient::getAssetRate()
     *
     * @return string
     */
    public function getMicrotime()
    {
        return $this->microtime;
    }

    /**
     * Definition ID. You should get it from Get Definitions method
     *
     * @see \Opteck\ApiClient::getDefinitions()
     *
     * @return int
     */
    public function getDefinitionId()
    {
        return $this->definitionId;
    }

    /**
     * Returns asset rate. Get it from Asset Rate method.
     *
     * @see \Opteck\ApiClient::getAssetRate()
     *
     * @return float
     */
    public function getStrike()
    {
        return $this->strike;
    }

    /**
     * Amount of the trade. Should be integer...
     *
     * @return int
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Returns direction of the trade. 1 - Up, -1 - Down
     *
     * @return int
     */
    public function getDirection()
    {
        return $this->direction;
    }

    const DIRECTION_UP = 1;

    const DIRECTION_DOWN = -1;

    protected $token;

    protected $timestamp;

    protected $microtime;

    protected $definitionId;

    protected $strike;

    protected $amount;

    protected $direction;

}
