<?php

declare(strict_types=1);

namespace Tests\Setono\KrakenIoBundle\DependencyInjection\Compiler;

use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractCompilerPassTestCase;
use Setono\KrakenIoBundle\DependencyInjection\Compiler\RegisterHttpClientPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;

final class RegisterHttpClientPassTest extends AbstractCompilerPassTestCase
{
    protected function registerCompilerPass(ContainerBuilder $container): void
    {
        $container->addCompilerPass(new RegisterHttpClientPass());
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
}
