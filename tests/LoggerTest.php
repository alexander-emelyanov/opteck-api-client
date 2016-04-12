<?php

namespace Opteck\Tests;

use Monolog\Logger;

class LoggerTest extends TestCase
{
    public function testDummyLogger()
    {
        $logger = new Logger('Logger');
        $this->apiClient->setLogger($logger);
    }
}
