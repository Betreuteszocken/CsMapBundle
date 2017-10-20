<?php

namespace Betreuteszocken\MapBundle\DependencyInjection;

use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\Config\FileLocator;

/**
 *
 * @link http://symfony.com/doc/current/bundles/extension.html
 */
class MapBundleExtension extends Extension
{

	/**
	 * @inheritdoc
	 */
	public function getAlias()
	{
		return 'cs_maps';
	}

	/**
	 * @inheritdoc
	 */
	public function load(array $configs, ContainerBuilder $container)
	{
		/** @var LoaderInterface $loader */
		$loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
		$loader->load('services.yml');

		$configuration = new Configuration();
		$config        = $this->processConfiguration($configuration, $configs);

		$container->setParameter('maps.config.path', $config[ 'path' ]);
		$container->setParameter('maps.config.default_maps', $config[ 'default_maps' ]);
		$container->setParameter('maps.config.categories', $config[ 'categories' ]);

	}

}