# Opteck platform API client

[![Build Status](https://img.shields.io/travis/alexander-emelyanov/opteck-api-client/master.svg?style=flat-square)](https://travis-ci.org/alexander-emelyanov/opteck-api-client)
[![StyleCI](https://styleci.io/repos/56054469/shield?)](https://styleci.io/repos/56054469)
[![Code Climate](https://img.shields.io/codeclimate/github/alexander-emelyanov/opteck-api-client.svg?style=flat-square)](https://codeclimate.com/github/alexander-emelyanov/opteck-api-client)

This repository contains PHP Client for Opteck platform.

Opteck is a trading platform for binary options.

## Installation
Install using [Composer](http://getcomposer.org), doubtless.

```sh
$ composer require alexander-emelyanov/opteck-api-client
```

## Usage

First, you need to create a client object to connect to the Opteck servers. You will need to acquire an Affiliate ID and 
Partner ID for your app first from [broker website ](http://www.optaffiliates.com/), then pass the credentials to the 
client object for logging in.

```php
$client = new \Opteck\ApiClient(<Affiliate ID>, <Partner ID>);
```

Assuming your credentials is valid, you are good to go!

### Create lead

You can create lead on the Opteck platform using one request.

```php
/** @var \Opteck\Requests\CreateLead $request */
$request = new \Opteck\Requests\CreateLead([
    'email'       => 'john.smith@gmail.com',
    'password'    => 'qwerty',
    'firstName'   => 'John',
    'lastName'    => 'Smith',
    'language'    => 'EN',
    'country'     => 'GB',
    'phone'       => '442088963321', // Pizza Hut Restaurant
    'campaign'    => 'test_campaign_1',
    'subCampaign' => 'test_sub_campaign_1',
]);

/** @var \Opteck\Responses\CreateLead $response */
$response = $apiClient->createLead($request);

echo "Lead created successfully with ID: " . $response->getLeadId() . PHP_EOL;
```

