<?php

namespace Opteck\Tests;

use Faker\Factory as FakerFactory;
use Opteck\ApiClient;

class TestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Opteck\ApiClient
     */
    protected $apiClient;

    /**
     * @var \Faker\Generator A Faker fake data generator.
     */
    protected $faker;

    /**
     * Sets up a test with some useful objects.
     */
    public function setUp()
    {
        $vars = ['partnerId', 'affiliateId'];
        $data = [];
        foreach ($vars as $var) {
            $envVar = strtoupper('OPTECK_'.strtoupper($var));
            if ($value = getenv($envVar)) {
                $data[$var] = $value;
            } else {
                throw new \Exception("Environment variable $envVar is required");
            }
        }
        $this->apiClient = new ApiClient($data['affiliateId'], $data['partnerId']);
        $this->faker = FakerFactory::create();
    }

    /**
     * Free resources.
     */
    public function tearDown()
    {
    }
}
