# Kraken.io Bundle

[![Latest Version][ico-version]][link-packagist]
[![Latest Unstable Version][ico-unstable-version]][link-packagist]
[![Software License][ico-license]](LICENSE)
[![Build Status][ico-travis]][link-travis]
[![Quality Score][ico-code-quality]][link-code-quality]

Integrates the [kraken.io PHP SDK](https://github.com/Setono/kraken-io-php-sdk) into Symfony.

## Installation

### Step 1: Download the bundle

Open a command console, enter your project directory and execute the following command to download the latest stable version of this plugin:

```bash
$ composer require setono/kraken-io-php-sdk
```

This command requires you to have Composer installed globally, as explained in the [installation chapter](https://getcomposer.org/doc/00-intro.md) of the Composer documentation.


### Step 2: Enable the bundle

Enable the plugin by adding it to the list of registered plugins/bundles in `config/bundles.php`:

```php
<?php
$bundles = [
    // ...
    
    Setono\KrakenIoBundle\SetonoKrakenIoBundle::class => ['all' => true],
    
    // ...
];
```

## Usage
Now you can inject the `ClientInterface` into your service:

```php
<?php

use Setono\Kraken\Client\ClientInterface;

final class YourService
{
    private $client;
    
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }
}
```

With auto wiring this will work out of the box. If you're not using auto wiring you have to inject it in your service definition:

```xml
<?xml version="1.0" encoding="UTF-8" ?>

<container xmlns="http://symfony.com/schema/dic/services" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://symfony.com/schema/dic/services http://symfony.com/schema/dic/services/services-1.0.xsd">
    <services>
        <service id="YourService">
            <argument type="service" id="Setono\Kraken\Client\ClientInterface"/>
        </service>
    </services>
</container>

```

[ico-version]: https://poser.pugx.org/setono/kraken-io-bundle/v/stable
[ico-unstable-version]: https://poser.pugx.org/setono/kraken-io-bundle/v/unstable
[ico-license]: https://poser.pugx.org/setono/kraken-io-bundle/license
[ico-travis]: https://travis-ci.com/Setono/KrakenIoBundle.svg?branch=master
[ico-code-quality]: https://img.shields.io/scrutinizer/g/Setono/KrakenIoBundle.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/setono/kraken-io-bundle
[link-travis]: https://travis-ci.com/Setono/KrakenIoBundle
[link-code-quality]: https://scrutinizer-ci.com/g/Setono/KrakenIoBundle
