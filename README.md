# Kraken.io Bundle

[![Latest Version][ico-version]][link-packagist]
[![Latest Unstable Version][ico-unstable-version]][link-packagist]
[![Software License][ico-license]](LICENSE)
[![Build Status][ico-github-actions]][link-github-actions]
[![Code Coverage][ico-code-coverage]][link-code-coverage]

Integrates the [kraken.io PHP SDK](https://github.com/Setono/kraken-io-php-sdk) into Symfony.

## Installation

### Step 1: Download the bundle

```bash
$ composer require setono/kraken-io-bundle
```

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

### Step 3: Add configuration

```yaml
# config/packages/setono_kraken_io.yaml
setono_kraken_io:
    api_key: your_api_key
    api_secret: your_api_secret
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
[ico-github-actions]: https://github.com/Setono/KrakenIoBundle/workflows/build/badge.svg
[ico-code-coverage]: https://codecov.io/gh/Setono/KrakenIoBundle/branch/master/graph/badge.svg

[link-packagist]: https://packagist.org/packages/setono/kraken-io-bundle
[link-github-actions]: https://github.com/Setono/KrakenIoBundle/actions
[link-code-coverage]: https://codecov.io/gh/Setono/KrakenIoBundle
