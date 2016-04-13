<?php

namespace Opteck\Tests;

use Opteck\Exceptions\LeadNotFoundException;

class GetLeadDetailsTest extends TestCase
{
    public function testLeadDetails()
    {
        // We are using existed email and password for avoid garbage in the live Opteck environment.
        $email = 'test.auth@gmail.com';
        $response = $this->apiClient->getLeadDetails($email);
        $this->assertGreaterThan(0, $response->getLeadId());
        $this->assertTrue(is_numeric($response->getBalance()), 'Lead balance should be a number');
        $this->assertEquals(3, strlen($response->getCurrencyCode()));
        $this->assertNotEmpty($response->getWebsiteLink());
        $this->assertNotEmpty($response->getPlatformPageLink());
        $this->assertNotEmpty($response->getDepositPageLink());
    }
}
