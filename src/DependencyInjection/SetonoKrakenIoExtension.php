<?php

declare(strict_types=1);

namespace Setono\KrakenIoBundle\DependencyInjection;

use Exception;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

final class SetonoKrakenIoExtension extends Extension
{
    /**
     * @throws Exception
     */
    public function load(array $config, ContainerBuilder $container): void
    {
        $config = $this->processConfiguration($this->getConfiguration([], $container), $config);
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));

        $container->setParameter('setono_kraken_io.api_key', $config['api_key']);
        $container->setParameter('setono_kraken_io.api_secret', $config['api_secret']);
        $container->setParameter('setono_kraken_io.base_url', $config['base_url']);

        if (isset($config['http_client'])) {
            $container->setParameter('setono_kraken_io.http_client_service_id', $config['http_client']);
        }

        if (isset($config['http_request_factory'])) {
            $container->setParameter('setono_kraken_io.http_request_factory_service_id', $config['http_request_factory']);
        }

        if (isset($config['http_stream_factory'])) {
            $container->setParameter('setono_kraken_io.http_stream_factory_service_id', $config['http_stream_factory']);
        }

        if (isset($config['response_factory'])) {
            $container->setParameter('setono_kraken_io.response_factory_service_id', $config['response_factory']);
        }

        $loader->load('services.xml');
    }
}
