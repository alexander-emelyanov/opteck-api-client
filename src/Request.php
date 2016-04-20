<?php

namespace Opteck;

class Request
{
    public function __construct($data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            } else {
                throw new \Exception("Unknown parameter name [$key]");
            }
        }
    }
}
