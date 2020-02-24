<?php

declare(strict_types=1);

namespace Setono\KrakenIoBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        if (method_exists(TreeBuilder::class, 'getRootNode')) {
            $treeBuilder = new TreeBuilder('setono_kraken_io');
            $rootNode = $treeBuilder->getRootNode();
        } else {
            // BC layer for symfony/config 4.1 and older
            $treeBuilder = new TreeBuilder();
            $rootNode = $treeBuilder->root('setono_kraken_io');
        }

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
                ->end()
                ->scalarNode('http_request_factory')
                    ->cannotBeEmpty()
                    ->info('Service id of your own request factory to use with the kraken.io client')
                ->end()
                ->scalarNode('http_stream_factory')
                    ->cannotBeEmpty()
                    ->info('Service id of your own stream factory to use with the kraken.io client')
                ->end()
                ->scalarNode('response_factory')
                    ->cannotBeEmpty()
                    ->info('Service id of your own response factory to use with the kraken.io client')
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
