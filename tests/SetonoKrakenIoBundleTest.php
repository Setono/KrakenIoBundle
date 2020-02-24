<?php

declare(strict_types=1);

namespace Tests\Setono\KrakenIoBundle\DependencyInjection;

use Nyholm\BundleTest\BaseBundleTestCase;
use Nyholm\BundleTest\CompilerPass\PublicServicePass;
use Setono\Kraken\Client\Client;
use Setono\KrakenIoBundle\SetonoKrakenIoBundle;

final class SetonoKrakenIoBundleTest extends BaseBundleTestCase
{
    protected function getBundleClass(): string
    {
        return SetonoKrakenIoBundle::class;
    }

    protected function setUp(): void
    {
        parent::setUp();

        // Make services public that have an id that matches a regex
        $this->addCompilerPass(new PublicServicePass('#setono_kraken_io.*#'));
    }

    /**
     * @test
     */
    public function init_bundle(): void
    {
        $kernel = $this->createKernel();
        $kernel->addConfigFile(__DIR__ . '/config/config.yaml');

        $this->bootKernel();

        $container = $this->getContainer();

        $this->assertTrue($container->has('setono_kraken_io.client'));
        $service = $container->get('setono_kraken_io.client');
        $this->assertInstanceOf(Client::class, $service);
    }
}
