# updown
UpDown.io PHP SDK

[![Build Status](https://travis-ci.org/biscolab/updown-php-sdk.svg?branch=master)](https://travis-ci.org/biscolab/updown-php-sdk)
[![Code Coverage](https://scrutinizer-ci.com/g/biscolab/updown-php-sdk/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/biscolab/updown-php-sdk/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/biscolab/updown-php-sdk/badges/build.png?b=master)](https://scrutinizer-ci.com/g/biscolab/updown-php-sdk/build-status/master)

First of all you need a [UpDown.io](https://updown.io) account.

Laravel package will be available soon!

Further info/documentation will be ready ASAP.

## Installation

You can install the package via composer:
```sh
composer require biscolab/updown
```

## Configuration

### API key

First of all you need an API key: [Get API Key](https://updown.io/settings/edit)

### Initialize the UpDown and create Check object

```php

use Biscolab\UpDown\UpDown;
use Biscolab\UpDown\Objects\Check;
use Biscolab\UpDown\Fields\UpDownRequestFields;

// Initialize UpDown 
UpDown::init([
    UpDownRequestFields::API_KEY => '<YOUR_UPDOWN_API_KEY>'
]);

// Create an empty "Check" CRUD object 
$check = new Check();

// OR

// Create an existing "Check" CRUD object 
$check = new Check($attributes);
```

* `$check` is a CRUD object, so it has `create`, `read`, `update` and `delete` methods available.
* `$attributes` could an array containing a list of attributes (`Biscolab\UpDown\Fields\CheckFields`) or a scalar value representing the token given by updown.io.  

## Usage
### Create Check object on updown.io
```php
$check = new Check($attributes);
$check->create();
```

### Read Check data from updown.io
```php
$check = new Check($token);
$check->read();

// get data as array
$array_data = $check->toArray();

// get single value
$url = $check->{UpDownRequestFields::URL};

```

>Use Enum values like `UpDownRequestFields` to avoid errors

### Update Check on updown.io
```php
$check = new Check($token);
$check->update($attributes);
```

### Delete Check from updown.io
```php
$check = new Check($token);
$deleted = $check->delete();
```

* `$deleted` is bool, `true` if "ok", `false` if something went wrong

### Get Check "Metrics" from updown.io
```php
$check = new Check($token);
$metrics = $check->getMetrics($from, $to, $group);
```

* `$metrics` is anf objact of class `Biscolab\UpDown\Types\Metrics`

### Get Check "Downtimes" from updown.io
```php
$check = new Check($token);
$downtimes = $check->getDowntimes($page);
```

* `$downtimes` is anf objact of class `Biscolab\UpDown\Types\DownTimes`, a collection of `Biscolab\UpDown\Types\DownTime` objects 


## License
[![MIT License](https://img.shields.io/github/license/biscolab/updown.svg)](https://github.com/biscolab/updown/blob/master/LICENSE)
