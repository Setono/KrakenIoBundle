<?php

declare(strict_types=1);

namespace Setono\KrakenIoBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;

final class RegisterHttpClientPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container): void
    {
        if (!$container->hasParameter('setono_kraken_io.http_client_service_id')) {
            return;
        }

        $httpClientServiceId = $container->getParameter('setono_kraken_io.http_client_service_id');
        if (!$container->has($httpClientServiceId)) {
            throw new ServiceNotFoundException($httpClientServiceId);
        }

        $container->setAlias('setono_kraken_io.http_client', $httpClientServiceId);
    }
}
