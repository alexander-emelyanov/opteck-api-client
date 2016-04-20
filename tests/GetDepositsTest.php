<?php

namespace Opteck\Tests;

class GetDepositsTest extends TestCase
{
    public function testDeposits()
    {
        $deposits = $this->apiClient->getDeposits(0);
        $this->assertTrue(is_array($deposits), 'Deposits set should be an array.');
    }
}
