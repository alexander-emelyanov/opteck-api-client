<?php

namespace Opteck\Responses;

use Opteck\Exceptions\LeadNotFoundException;
use Opteck\Payload;
use Opteck\Response;

class GetLeadDetails extends Response
{
    const RETURN_CODE_LEAD_NOT_FOUND = 6;

    const FIELD_LEAD_ID = 'leadID';

    const FIELD_BALANCE = 'balance';

    const FIELD_CURRENCY_CODE = 'currencyCode';

    const FIELD_WEBSITE_LINK = 'websiteLink';

    const FIELD_PLATFORM_PAGE_LINK = 'platformPageLink';

    const FIELD_DEPOSIT_PAGE_LINK = 'depositPageLink';

    public function __construct(Payload $payload)
    {
        $this->data = $payload;
        if ($this->getReturnCode() == static::RETURN_CODE_LEAD_NOT_FOUND) {
            throw new LeadNotFoundException($this, $this->getDescription());
        }
        parent::__construct($payload);
    }

    /**
     * Returns Lead ID, e.g. 140823514962.
     *
     * @return int
     */
    public function getLeadId()
    {
        return intval($this->data[static::FIELD_DATA][static::FIELD_LEAD_ID]);
    }

    /**
     * Returns lead balance in original currency.
     *
     * @return float
     */
    public function getBalance()
    {
        return floatval($this->data[static::FIELD_DATA][static::FIELD_BALANCE]);
    }

    /**
     * Returns lead currency in ISO 4217, e.g. 'USD'.
     *
     * @return string
     */
    public function getCurrencyCode()
    {
        return $this->data[static::FIELD_DATA][static::FIELD_CURRENCY_CODE];
    }

    /**
     * Returns the link for force login to website.
     *
     * @return string
     */
    public function getWebsiteLink()
    {
        return $this->data[static::FIELD_DATA][static::FIELD_WEBSITE_LINK];
    }

    /**
     * Returns the link for force login to trading platform.
     *
     * @return string
     */
    public function getPlatformPageLink()
    {
        return $this->data[static::FIELD_DATA][static::FIELD_PLATFORM_PAGE_LINK];
    }

    /**
     * Returns the link for force login to deposit page.
     *
     * @return string
     */
    public function getDepositPageLink()
    {
        return $this->data[static::FIELD_DATA][static::FIELD_DEPOSIT_PAGE_LINK];
    }
}
