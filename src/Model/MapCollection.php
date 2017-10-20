<?php

namespace Betreuteszocken\MapBundle\Model;

/**
 * Class Map
 *
 * @package MapBundle
 */
class MapCollection extends \ArrayObject implements MapCollectionInterface
{

	/**
	 * {@inheritdoc}
	 */
	public function addMap(Map $map)
	{
		if( $this->offsetExists($map->getPath()) )
		{
			return false;
		}

		$this->append($map);
		return true;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getChoices()
	{
		$choices = array();

		/** @var Map $_map */
		foreach( $this as $_map )
		{
			$choices[ $_map->getName() ] = $_map->getName();
		}

		return $choices;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getMapNames()
	{
		$map_names = array();

		/** @var Map $_map */
		foreach( $this as $_map )
		{
			array_push($map_names, $_map->getName());
		}

		return $map_names;
	}
}
