<?php

declare(strict_types=1);

namespace Tests\Setono\KrakenIoBundle\DependencyInjection\Compiler;

use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractCompilerPassTestCase;
use Setono\KrakenIoBundle\DependencyInjection\Compiler\RegisterAliasesPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;

/**
 * @çovers \Setono\KrakenIoBundle\DependencyInjection\Compiler\RegisterAliasesPass
 */
final class RegisterAliasesPassTest extends AbstractCompilerPassTestCase
{
    protected function registerCompilerPass(ContainerBuilder $container): void
    {
        $container->addCompilerPass(new RegisterAliasesPass());
    }

    /**
     * @test
     */
    public function if_request_factory_parameter_is_set_the_service_alias_exists(): void
    {
        $this->setParameter('setono_kraken_io.http_request_factory_service_id', 'request_factory_service_id');
        $this->setDefinition('request_factory_service_id', new Definition());

        $this->compile();

        $this->assertContainerBuilderHasAlias('setono_kraken_io.http_request_factory', 'request_factory_service_id');
    }

    /**
     * @test
     */
    public function if_http_client_parameter_is_set_the_service_alias_exists(): void
    {
        $this->setParameter('setono_kraken_io.http_client_service_id', 'http_client_service_id');
        $this->setDefinition('http_client_service_id', new Definition());

        $this->compile();

        $this->assertContainerBuilderHasAlias('setono_kraken_io.http_client', 'http_client_service_id');
    }

    /**
     * @test
     */
    public function it_throws_exception_if_service_does_not_exist(): void
    {
        $this->expectException(ServiceNotFoundException::class);

        $this->setParameter('setono_kraken_io.http_client_service_id', 'http_client_service_id');

        $this->compile();
    }
}
