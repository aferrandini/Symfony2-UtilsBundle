<?php

namespace Ferrandini\UtilsBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\DependencyInjection\Definition;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class FerrandiniUtilsExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services_parameters.xml');

        if(isset($config['distance']['enabled']) && $config['distance']['enabled']) {
            $definition = new Definition('%ferrandini_utils.distance.class%');

            $container->setDefinition('ferrandini_utils.distance', $definition);
        }

        if(isset($config['slugger']['enabled']) && $config['slugger']['enabled']) {
            $definition = new Definition('%ferrandini_utils.slugger.class%');
            $definition->addArgument($config['slugger']['max_length']);

            $container->setDefinition('ferrandini_utils.slugger', $definition);
        }

        if(isset($config['blackberry_push']['enabled']) && $config['blackberry_push']['enabled']) {
            $this->configureBlackBerryPushApplications($config, $container);

            if(isset($config['blackberry_push']['applications']) && is_array($config['blackberry_push']['applications'])) {
                $container->setDefinition('ferrandini_utils.slugger', new Definition(
                    '%ferrandini_utils.slugger.class%'
                ));
            }
        }
        

    }
}
