<?php

namespace Betreuteszocken\MapBundle\Model;

/**
 * Class Map
 *
 * @package MapBundle
 */
interface MapCollectionInterface
{
	/**
	 * @param Map $map
	 *
	 * @return boolean
	 */
	public function addMap(Map $map);

	/**
	 * @return mixed[]
	 */
	public function getChoices();

	/**
	 * @return string[]
	 */
	public function getMapNames();
}
