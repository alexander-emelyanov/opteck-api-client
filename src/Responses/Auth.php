<?php

namespace Opteck\Responses;

use Opteck\Payload;
use Opteck\Response;

class Auth extends Response
{
    const FIELD_TOKEN = 'token';

    const FIELD_EXPIRY_DATE = 'expiryDate';

//    const RETURN_CODE_EMAIL_ALREADY_EXISTS = 11;

    public function __construct(Payload $payload)
    {
        $this->data = $payload;
//        if ($this->getReturnCode() == static::RETURN_CODE_EMAIL_ALREADY_EXISTS) {
//            throw new EmailAlreadyExistsException($this, 'Email already exists');
//        }
//        parent::__construct($payload);
    }

    /**
     * Returns temporary token used in ​Trade Action​ method.
     *
     * @return string
     */
    public function getToken()
    {
        return $this->data[static::FIELD_DATA][static::FIELD_TOKEN];
    }

    /**
     * Returns the UNIX timestamp when token will be expired.
     *
     * @return int
     */
    public function getExpiryTimestamp()
    {
        return strtotime($this->data[static::FIELD_DATA][static::FIELD_EXPIRY_DATE]);
    }
}
