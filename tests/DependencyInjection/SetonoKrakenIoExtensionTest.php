<?php

declare(strict_types=1);

namespace Tests\Setono\KrakenIoBundle\DependencyInjection;

use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractExtensionTestCase;
use Setono\Kraken\Client\Client;
use Setono\Kraken\Client\ClientInterface;
use Setono\KrakenIoBundle\DependencyInjection\SetonoKrakenIoExtension;

/**
 * @covers \Setono\KrakenIoBundle\DependencyInjection\SetonoKrakenIoExtension
 */
final class SetonoKrakenIoExtensionTest extends AbstractExtensionTestCase
{
    protected function getContainerExtensions(): array
    {
        return [new SetonoKrakenIoExtension()];
    }

    protected function getMinimalConfiguration(): array
    {
        return [
            'api_key' => 'api key',
            'api_secret' => 'api secret',
        ];
    }

    /**
     * @test
     */
    public function after_loading_the_correct_parameter_has_been_set(): void
    {
        $this->load([
            'base_url' => 'base_url',
            'http_client' => 'http_client_service_id',
            'http_request_factory' => 'request_factory_service_id',
            'http_stream_factory' => 'stream_factory_service_id',
            'response_factory' => 'response_factory_service_id',
        ]);

        $this->assertContainerBuilderHasParameter('setono_kraken_io.api_key', 'api key');
        $this->assertContainerBuilderHasParameter('setono_kraken_io.api_secret', 'api secret');
        $this->assertContainerBuilderHasParameter('setono_kraken_io.base_url', 'base_url');
        $this->assertContainerBuilderHasParameter('setono_kraken_io.http_client_service_id', 'http_client_service_id');
        $this->assertContainerBuilderHasParameter('setono_kraken_io.http_request_factory_service_id', 'request_factory_service_id');
        $this->assertContainerBuilderHasParameter('setono_kraken_io.http_stream_factory_service_id', 'stream_factory_service_id');
        $this->assertContainerBuilderHasParameter('setono_kraken_io.response_factory_service_id', 'response_factory_service_id');
    }

    /**
     * @test
     */
    public function after_loading_the_services_exist(): void
    {
        $this->load();

        $this->assertContainerBuilderHasService('setono_kraken_io.client', Client::class);
    }

    /**
     * @test
     */
    public function after_loading_the_aliases_exist(): void
    {
        $this->load();

        $this->assertContainerBuilderHasAlias(ClientInterface::class, 'setono_kraken_io.client');
    }
}
