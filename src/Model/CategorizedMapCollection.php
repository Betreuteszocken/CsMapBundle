<?php

namespace Betreuteszocken\MapBundle\Model;

/**
 * Class Map
 *
 * @package MapBundle
 */
class CategorizedMapCollection extends MapCollection implements MapCollectionInterface
{

	/**
	 * @var Category
	 */
	protected $category = null;

	/**
	 * CategorizedMapCollection constructor.
	 *
	 * @param Category $category
	 */
	public function __construct(Category $category)
	{
		parent::__construct();

		$this->category = $category;
	}

	/**
	 * @param Map $map
	 *
	 * @return boolean
	 */
	public function isValidForMap(Map $map)
	{
		return ( preg_match(sprintf('/%s/i', $this->category->getRegex(), '/'), $map->getBasename()) === 1 );
	}


	/**
	 *
	 * @return boolean
	 */
	public function isGarbage()
	{
		return is_null($this->category->getRegex());
	}

	/**
	 * @return Category
	 */
	public function getCategory()
	{
		return $this->category;
	}
}
