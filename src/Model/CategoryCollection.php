<?php

namespace Betreuteszocken\MapBundle\Model;

/**
 * Class Map
 *
 * @package MapBundle
 */
class CategoryCollection extends \ArrayObject implements MapCollectionInterface
{
	/**
	 * @var string|null
	 */
	protected $garbageMapCollectionKey = null;

	public function addCategory(Category $category)
	{
		if( $this->offsetExists($category->getKey()) )
		{
			throw new \UnexpectedValueException(sprintf('The map category "%s" was already added.', $category->getKey()));
		}

		if( is_null($category->getRegex()) )
		{
			if( !is_null($this->garbageMapCollectionKey) )
			{
				throw new \UnexpectedValueException(sprintf('Only one category without regex is allowed, got "%s" and "%s".',
					$this->garbageMapCollectionKey,
					$category->getKey()
				));
			}

			$this->garbageMapCollectionKey = $category->getKey();
		}

		$this->offsetSet($category->getKey(), new CategorizedMapCollection($category));
	}

	/**
	 * {@inheritdoc}
	 */
	public function addMap(Map $map)
	{
		foreach( $this as $_categorized_map_collection )
		{
			/** @var CategorizedMapCollection $_categorized_map_collection */
			if( !$_categorized_map_collection->isGarbage() && $_categorized_map_collection->isValidForMap($map) )
			{
				return $_categorized_map_collection->addMap($map);
			}
		}

		if( is_null($this->garbageMapCollectionKey) )
		{
			$this->garbageMapCollectionKey = 'others';
			$this->offsetSet($this->garbageMapCollectionKey, new CategorizedMapCollection(new Category($this->garbageMapCollectionKey)));
		}

		/** @var CategorizedMapCollection $categorized_map_collection */
		$categorized_map_collection = $this->offsetGet($this->garbageMapCollectionKey);
		return $categorized_map_collection->addMap($map);
	}

	/**
	 * {@inheritdoc}
	 */
	public function getChoices()
	{
		$choices = array();

		foreach( $this as $_categorized_map_collection )
		{
			/** @var CategorizedMapCollection $_categorized_map_collection */
			$key = !$_categorized_map_collection->isGarbage() ?
				$_categorized_map_collection->getCategory()->getKey() :
				'others';

			$choices[ $key ] = $_categorized_map_collection->getChoices();

		}

		return $choices;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getMapNames()
	{
		$map_names = array();

		/** @var CategorizedMapCollection $_categorized_map_collection */
		foreach( $this as $_categorized_map_collection )
		{
			$map_names = array_merge($map_names, $_categorized_map_collection->getMapNames());
		}

		return array_filter(array_unique($map_names));
	}
}
