<?php

namespace Opteck;

class Exception extends \Exception
{
    /**
     * @var \Opteck\Response
     */
    private $response = null;

    public function __construct(Response $response = null, $message = '', $code = 0, \Exception $previous = null)
    {
        $exception = parent::__construct($message, $code, $previous);
        $this->response = $response;

        return $exception;
    }

    /**
     * @return \Opteck\Response
     */
    public function getResponse()
    {
        return $this->response;
    }
}
