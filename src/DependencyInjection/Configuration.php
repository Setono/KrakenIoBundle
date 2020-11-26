<?php

declare(strict_types=1);

namespace Setono\KrakenIoBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('setono_kraken_io');
        $rootNode = $treeBuilder->getRootNode();

        /**
         * @psalm-suppress MixedMethodCall
         * @psalm-suppress PossiblyUndefinedMethod
         */
        $rootNode
            ->addDefaultsIfNotSet()
            ->children()
                ->scalarNode('api_key')
                    ->isRequired()
                    ->cannotBeEmpty()
                    ->info('The API key you have received from kraken.io')
                ->end()
                ->scalarNode('api_secret')
                    ->isRequired()
                    ->cannotBeEmpty()
                    ->info('The API secret you have received from kraken.io')
                ->end()
                ->scalarNode('base_url')
                    ->cannotBeEmpty()
                    ->defaultValue('https://api.kraken.io')
                    ->info('The base URL of the kraken.io API')
                ->end()
                ->scalarNode('http_client')
                    ->cannotBeEmpty()
                    ->info('Service id of your own PSR18 HTTP client to use with the kraken.io client')
                    ->setDeprecated(
                        'setono/kraken-io-bundle',
                        '1.1',
                        'The child node "%node%" at path "%path%" is deprecated. Define the service "setono_kraken_io.http_client" directly instead'
                    )
                ->end()
                ->scalarNode('http_request_factory')
                    ->cannotBeEmpty()
                    ->info('Service id of your own http request factory to use with the kraken.io client')
                    ->setDeprecated(
                        'setono/kraken-io-bundle',
                        '1.1',
                        'The child node "%node%" at path "%path%" is deprecated. Define the service "setono_kraken_io.http_request_factory" directly instead'
                    )
                ->end()
                ->scalarNode('http_stream_factory')
                    ->cannotBeEmpty()
                    ->info('Service id of your own http stream factory to use with the kraken.io client')
                    ->setDeprecated(
                        'setono/kraken-io-bundle',
                        '1.1',
                        'The child node "%node%" at path "%path%" is deprecated. Define the service "setono_kraken_io.http_stream_factory" directly instead'
                    )
                ->end()
                ->scalarNode('response_factory')
                    ->cannotBeEmpty()
                    ->info('Service id of your own response factory to use with the kraken.io client')
                    ->setDeprecated(
                        'setono/kraken-io-bundle',
                        '1.1',
                        'The child node "%node%" at path "%path%" is deprecated. Define the service "setono_kraken_io.response_factory" directly instead'
                    )
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
