<?php

namespace Opteck\Tests;

use Opteck\Exceptions\LeadNotFoundException;

class AuthTest extends TestCase
{
    public function testValidAuth()
    {
        // We are using existed email and password for avoid garbage in the live Opteck environment.
        $email = 'test.auth@gmail.com';
        $password = 'qwerty';
        $authResponse = $this->apiClient->auth($email, $password);
        $this->assertNotEmpty($authResponse->getToken(), 'We should get non-empty token.');
        $this->assertGreaterThan(time(), $authResponse->getExpiryTimestamp(), 'We should get active token, not expired.');
    }

    public function testInvalidAuth()
    {
        $email = md5(rand()) . '@gmail.com';
        $password = md5(rand());

        try {
            $this->apiClient->auth($email, $password);
            $this->assertTrue(false, 'Fake random lead can not be authorized.');
        } catch (LeadNotFoundException $e) {
            $this->assertTrue(true, 'Lead not found error handled successfully.');
        }
    }
}
