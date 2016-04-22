<?php

namespace Opteck\Tests;

use Opteck\Request;

class RequestsTest extends TestCase
{
    /**
     * @expectedException \Exception
     */
    public function testRequestWrongParameterName()
    {
        new Request(['x' => null]);
    }
}