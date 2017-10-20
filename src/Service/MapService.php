<?php

namespace Betreuteszocken\MapBundle\Service;

use Betreuteszocken\MapBundle\Model\CategorizedMapCollection;
use Betreuteszocken\MapBundle\Model\Category;
use Betreuteszocken\MapBundle\Model\CategoryCollection;
use Betreuteszocken\MapBundle\Model\Map;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class MapService implements ContainerAwareInterface
{
	use ContainerAwareTrait;

	/**
	 * @var CategorizedMapCollection[]|CategoryCollection
	 */
	protected $maps = null;

	protected function initMaps(\DirectoryIterator $directory_iterator)
	{
		$default_maps = $this->container->getParameter('maps.config.default_maps');

		foreach( $directory_iterator as $_iterator )
		{
			/** @var \DirectoryIterator $_iterator */

			if( $_iterator->isDot() )
			{
				continue;
			}

			if( $_iterator->isDir() )
			{
				$this->initMaps(new \DirectoryIterator($_iterator->getRealPath()));
			}

			if( $_iterator->getExtension() !== 'bsp' )
			{
				continue;
			}

			$_map = new Map($_iterator->getRealPath());

			$_map->setOrigin(
				in_array($_map->getName(), $default_maps)
			);

			$this->maps->addMap($_map);
		}
	}

	/**
	 * @return CategorizedMapCollection[]|CategoryCollection
	 */
	public function getMaps()
	{
		$categories = $this->container->getParameter('maps.config.categories');

		if( is_null($this->maps) )
		{
			$path = $this->container->getParameter('maps.config.path');

			$this->maps = new CategoryCollection();

			foreach( $categories as $_key => $_category )
			{
				$this->maps->addCategory(new Category($_key, $_category[ 'regex' ]));
			}
			
			$this->initMaps(new \DirectoryIterator($path));
		}

		return $this->maps;
	}
}
