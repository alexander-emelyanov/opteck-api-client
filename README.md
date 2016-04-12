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

First, you need to create a client object to connect to the Opteck servers. You will need to acquire an API username and API password for your app first from [broker website ](http://www.optaffiliates.com/), then pass the credentials to the client object for logging in. 

```php
$client = new \Opteck\ApiClient();
```

Assuming your credentials is valid, you are good to go!

