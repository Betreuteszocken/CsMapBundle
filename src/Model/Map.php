<?php

namespace Betreuteszocken\MapBundle\Model;

/**
 * Class Map
 *
 * @package MapBundle
 */
class Map implements MapInterface
{

	/**
	 * the (absolute) of the map file
	 *
	 * @var string
	 */
	protected $path = '';

	/**
	 * indicates, whether the the map is an origin cs1.6 map (`true`) or not (`false`)
	 *
	 * @var boolean
	 */
	protected $origin = false;

	/**
	 * @param string $path the (absolute) of the map file
	 */
	public function __construct($path)
	{
		$this->path = $path;
	}

	/**
	 * @return string
	 */
	public function getPath()
	{
		return $this->path;
	}

	/**
	 * @return string
	 */
	public function getBasename()
	{
		return pathinfo($this->path, PATHINFO_BASENAME);
	}

	/**
	 * {@inheritdoc}
	 */
	public function getName()
	{
		return preg_filter('/^(.+)\.bsp$/i', '$1', $this->getBasename());
	}

	/**
	 * {@inheritdoc}
	 */
	public function isOrigin()
	{
		return $this->origin;
	}

	/**
	 * @param boolean $origin
	 *
	 * @return Map
	 */
	public function setOrigin($origin)
	{
		$this->origin = $origin;
		return $this;
	}
}
