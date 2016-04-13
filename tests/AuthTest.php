<?php

namespace Opteck\Tests;

class AuthTest extends TestCase
{
    public function testCorrectAuth()
    {
        // We are using existed email and password for avoid garbage in the live Opteck environment.
        $email = 'test.auth@gmail.com';
        $password = 'qwerty';
        $authResponse = $this->apiClient->auth($email, $password);
        $this->assertNotEmpty($authResponse->getToken(), 'We should get non-empty token.');
        $this->assertGreaterThan(time(), $authResponse->getExpiryTimestamp(), 'We should get active token, not expired.');
    }
}
