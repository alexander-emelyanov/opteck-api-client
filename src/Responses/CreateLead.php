<?php

namespace Opteck\Responses;

use Opteck\Exceptions\EmailAlreadyExistsException;
use Opteck\Payload;
use Opteck\Response;

class CreateLead extends Response
{
    const FIELD_LEAD_ID = 'leadID';

    const RETURN_CODE_EMAIL_ALREADY_EXISTS = 11;

    public function __construct(Payload $payload)
    {
        $this->data = $payload;
        if ($this->getReturnCode() == static::RETURN_CODE_EMAIL_ALREADY_EXISTS) {
            throw new EmailAlreadyExistsException($this, 'Email already exists');
        }
        parent::__construct($payload);
    }

    public function getLeadId()
    {
        return $this->data[static::FIELD_DATA][static::FIELD_LEAD_ID];
    }
}
