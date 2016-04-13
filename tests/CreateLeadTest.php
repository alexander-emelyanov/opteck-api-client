<?php

namespace Opteck\Tests;

use Opteck\Exceptions\EmailAlreadyExistsException;
use Opteck\Requests\CreateLead as CreateLeadRequest;

class CreateLeadTest extends TestCase
{
    public function testForbiddenCountries(){
        $countries = $this->apiClient->getForbiddenCountries();
        $this->assertNotEmpty($countries);
    }

    public function testEmailAlreadyExists()
    {
        /** @var \Opteck\Requests\CreateLead $request */
        $request = new CreateLeadRequest([
            'email'       => 'test@gmail.com',
            'firstName'   => 'John',
            'lastName'    => 'Smith',
            'language'    => 'EN',
            'country'     => 'GB',
            'phone'       => '442088963321', // Pizza Hut Restaurant
            'campaign'    => 'campaign_test_1',
            'subCampaign' => 'sub_campaign_1',
        ]);

        /* @var \Opteck\Responses\CreateLead $response */
        try {
            $this->apiClient->createLead($request);
            $this->assertTrue(false, 'Lead with email "test@gmail.com" must not be created...');
        } catch (EmailAlreadyExistsException $e) {
            $this->assertTrue(true, 'Email already exists error handled perfectly.');
        }
    }
}
