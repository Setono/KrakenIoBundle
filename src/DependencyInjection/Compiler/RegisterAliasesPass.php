<?php

declare(strict_types=1);

namespace Setono\KrakenIoBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;

final class RegisterAliasesPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container): void
    {
        $this->registerFactory($container, 'setono_kraken_io.http_client_service_id', 'setono_kraken_io.http_client');
        $this->registerFactory($container, 'setono_kraken_io.http_request_factory_service_id', 'setono_kraken_io.http_request_factory');
        $this->registerFactory($container, 'setono_kraken_io.http_stream_factory_service_id', 'setono_kraken_io.http_stream_factory');
        $this->registerFactory($container, 'setono_kraken_io.response_factory_service_id', 'setono_kraken_io.response_factory');
    }

    private function registerFactory(ContainerBuilder $container, string $parameter, string $alias): void
    {
        if (!$container->hasParameter($parameter)) {
            return;
        }

        $serviceId = $container->getParameter($parameter);
        if (!$container->has($serviceId)) {
            throw new ServiceNotFoundException($serviceId);
        }

        $container->setAlias($alias, $serviceId);
    }
}
