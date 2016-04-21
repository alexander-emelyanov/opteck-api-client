<?php

namespace Opteck\Tests;

use Opteck\Exception;

class ExceptionsTest extends TestCase
{
    public function testException()
    {
        $exception = new Exception(null);
        $this->assertEquals(null, $exception->getMessage());
    }
}
