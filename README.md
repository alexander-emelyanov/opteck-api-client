# Opteck platform API client

This repository contains PHP Client for Opteck platform.

Opteck is a trading platform for binary options.

## Installation
Install using [Composer](http://getcomposer.org), doubtless.

```sh
$ composer require alexander-emelyanov/opteck-api-client
```

## Usage

First, you need to create a client object to connect to the Opteck servers. You will need to acquire an API username and API password for your app first from [broker website ](http://www.optaffiliates.com/), then pass the credentials to the client object for logging in. 

```php
$client = new \Opteck\ApiClient();
```

Assuming your credentials is valid, you are good to go!

