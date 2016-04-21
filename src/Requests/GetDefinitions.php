<?php

namespace Opteck\Requests;

use Opteck\Request;

class GetDefinitions extends Request
{
    /**
     * Returns Asset ID.
     *
     * @return int
     */
    public function getAssetId()
    {
        return $this->assetId;
    }

    /**
     * Returns status of the definition (enabled or disabled).
     *
     * @return bool
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Returns Option Type ID.
     *
     * @return int
     */
    public function getOptionTypeId()
    {
        return $this->optionTypeId;
    }

    protected $assetId;

    protected $isActive;

    protected $optionTypeId;
}
