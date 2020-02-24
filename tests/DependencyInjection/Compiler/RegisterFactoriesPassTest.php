<?php

declare(strict_types=1);

namespace Tests\Setono\KrakenIoBundle\DependencyInjection\Compiler;

use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractCompilerPassTestCase;
use Setono\KrakenIoBundle\DependencyInjection\Compiler\RegisterFactoriesPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;

final class RegisterFactoriesPassTest extends AbstractCompilerPassTestCase
{
    protected function registerCompilerPass(ContainerBuilder $container): void
    {
        $container->addCompilerPass(new RegisterFactoriesPass());
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
}
