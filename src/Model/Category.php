<?php

namespace Betreuteszocken\MapBundle\Model;

/**
 * Class Map
 *
 * @package MapBundle
 */
class Category
{

	/**
	 *
	 * @var string
	 */
	protected $key = '';

	/**
	 *
	 * @var string|null
	 */
	protected $regex = null;

	/**
	 * @param string      $key   the key of the category
	 * @param string|null $regex the regex or null, if no regex is defined
	 */
	public function __construct($key, $regex = null)
	{
		$this->key   = $key;
		$this->regex = $regex;
	}

	/**
	 * @return string
	 */
	public function getKey()
	{
		return $this->key;
	}

	/**
	 * @return null|string
	 */
	public function getRegex()
	{
		return $this->regex;
	}
}
