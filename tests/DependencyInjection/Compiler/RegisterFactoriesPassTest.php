<?php

declare(strict_types=1);

namespace Tests\Setono\KrakenIoBundle\DependencyInjection\Compiler;

use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractCompilerPassTestCase;
use Psr\Http\Message\RequestFactoryInterface;
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
        $this->setParameter('setono_kraken_io.request_factory', 'request_factory_service_id');
        $this->setDefinition('request_factory_service_id', new Definition());

        $this->compile();

        $this->assertContainerBuilderHasAlias('setono_kraken_io.request_factory', 'request_factory_service_id');
    }

    /**
     * @test
     */
    public function if_request_factory_interface_exists_the_service_alias_exists(): void
    {
        $this->setDefinition(RequestFactoryInterface::class, new Definition());

        $this->compile();

        $this->assertContainerBuilderHasAlias('setono_kraken_io.request_factory', RequestFactoryInterface::class);
    }

    /**
     * @test
     */
    public function if_nyholms_request_factory_exists_the_service_alias_exists(): void
    {
        $this->setDefinition('nyholm.psr7.psr17_factory', new Definition());

        $this->compile();

        $this->assertContainerBuilderHasAlias('setono_kraken_io.request_factory', 'nyholm.psr7.psr17_factory');
    }

    /**
     * @test
     */
    public function if_psr17_factory_class_exists_the_service_alias_exists(): void
    {
        $this->compile();

        $this->assertContainerBuilderHasAlias('setono_kraken_io.request_factory', 'setono_kraken_io.psr17_factory');
    }
}
