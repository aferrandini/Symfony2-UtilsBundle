<?php

namespace Ferrandini\UtilsBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('ferrandini_utils');

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.

        $rootNode
            ->children()
                ->arrayNode('distance')
                    ->children()
                        ->booleanNode('enabled')->end()
                    ->end()
                ->end()
            ->end()

            ->children()
                ->arrayNode('slugger')
                    ->children()
                        ->booleanNode('enabled')->end()
                    ->end()
                    ->children()
                        ->scalarNode('max_length')->defaultValue(50)->end()
                    ->end()
                    ->children()
                        ->arrayNode('applications')
                            ->requiresAtLeastOneElement()
                            ->prototype('array')
                                ->children()
                                    ->scalarNode('host')->end()
                                    ->scalarNode('username')->end()
                                    ->scalarNode('password')->end()
                                    ->scalarNode('app_id')->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
