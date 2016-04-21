<?php

namespace Opteck;

class Response
{
    const FIELD_RETURN_CODE = 'returnCode';

    const FIELD_DESCRIPTION = 'description';

    const FIELD_INVALID_FIELDS = 'invalidFields';

    const FIELD_DATA = 'data';

    const RETURN_CODE_SUCCESSFUL_CALL = 1;

    public function __construct(Payload $payload)
    {
        $this->data = $payload;
        $this->check();
        if (!$this->isSuccess()) {
            throw new Exception($this, $this->getDescription());
        }
    }

    /**
     * Override this method for custom response checks.
     *
     * @return bool
     */
    protected function check()
    {
        return true;
    }

    public function isSuccess()
    {
        return $this->getReturnCode() == static::RETURN_CODE_SUCCESSFUL_CALL;
    }

    public function getReturnCode()
    {
        return $this->data[static::FIELD_RETURN_CODE];
    }

    public function getDescription()
    {
        return $this->data[static::FIELD_DESCRIPTION];
    }

    public function getInvalidFields()
    {
        return $this->data[static::FIELD_INVALID_FIELDS];
    }
}
