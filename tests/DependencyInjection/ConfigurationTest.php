<?php

declare(strict_types=1);

namespace Tests\Setono\KrakenIoBundle\DependencyInjection;

use Matthias\SymfonyConfigTest\PhpUnit\ConfigurationTestCaseTrait;
use PHPUnit\Framework\TestCase;
use Setono\KrakenIoBundle\DependencyInjection\Configuration;

final class ConfigurationTest extends TestCase
{
    use ConfigurationTestCaseTrait;

    protected function getConfiguration(): Configuration
    {
        return new Configuration();
    }

    /**
     * @test
     */
    public function values_are_invalid_if_required_value_is_not_provided(): void
    {
        $this->assertConfigurationIsInvalid(
            [[]],
            'The child node "api_key" at path "setono_kraken_io" must be configured.' // (part of) the expected exception message - optional
        );
    }

    /**
     * @test
     */
    public function processed_value_contains_required_value(): void
    {
        $this->assertProcessedConfigurationEquals([
            ['api_key' => 'first value', 'api_secret' => 'api secret'],
            ['api_key' => 'last value'],
        ], [
            'api_key' => 'last value',
            'api_secret' => 'api secret',
            'base_url' => 'https://api.kraken.io',
        ]);
    }
}
