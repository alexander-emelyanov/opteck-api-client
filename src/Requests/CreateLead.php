<?php

namespace Opteck\Requests;

use Opteck\Request;

class CreateLead extends Request
{
    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @return string
     */
    public function getCampaign()
    {
        return $this->campaign;
    }

    /**
     * @return string
     */
    public function getSubCampaign()
    {
        return $this->subCampaign;
    }

    /**
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    public function getMarker()
    {
        return $this->marker;
    }

    /**
     * Email address. It should be valid. Mandatory.
     *
     * @var string
     */
    protected $email;

    /**
     * Lead password. Optional.
     *
     * @var string
     */
    protected $password;

    /**
     * Mandatory.
     *
     * @var string
     */
    protected $firstName;

    /**
     * Mandatory.
     *
     * @var string
     */
    protected $lastName;

    /**
     * Phone number. Mandatory.
     *
     * @var string
     */
    protected $phone;

    /**
     * Language code in ISO 639­1. Mandatory.
     * Example: EN, FR, PL, etc.
     *
     * @var string
     */
    protected $language;

    /**
     * Country code in ISO 3166­1. Mandatory.
     * Example: GB, FR, etc.
     *
     * @var string
     */
    protected $country;

    /**
     * Lead IP address, e.g. 127.0.0.1. Optional.
     *
     * @var string
     */
    protected $ip;

    /**
     * Campaign tracking. Optional.
     *
     * @var string
     */
    protected $campaign;

    /**
     * Sub campaign tracking. Optional.
     *
     * @var string
     */
    protected $subCampaign;

    /**
     * Comment about lead. Optional.
     *
     * @var string
     */
    protected $comment;

    /**
     * Short info about lead that might be crucial for lead conversion. Always visible to agents. Length: ≤140. Optional.
     *
     * @var string
     */
    protected $marker;
}
