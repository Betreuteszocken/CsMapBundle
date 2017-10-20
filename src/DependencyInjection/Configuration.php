<?php

namespace Betreuteszocken\MapBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
	/**
	 * {@inheritdoc}
	 */
	public function getConfigTreeBuilder()
	{
		$treeBuilder = new TreeBuilder();
		$rootNode    = $treeBuilder->root('cs_maps');

		// @formatter:off
        $rootNode
			->info('DateTime Bundle Configuration')
			->children()
				->scalarNode('path')
					->info('The timezone of the datetime values which are saved and will be saved in the database. If empty, the server timezone (see `date_default_timezone_get`) wil be choosen.')
					->defaultValue('')
					->cannotBeEmpty()
					->validate()
						->ifTrue(function ($_value) { return $this->directoryIsNotReadable($_value); })
						->thenInvalid('Some directories do not exist or are not writable.')
					->end()
				->end()
				->arrayNode('default_maps')
					->info('This setting is optional. You can overwrite all default cs1.6 maps by inserting your custom maps.')
					->info('https://forums.alliedmods.net/showthread.php?t=52712')
					->prototype('scalar')->end()
					->defaultValue([
						"de_airstrip",
						"cs_havana",
						"de_chateau",
						"de_aztec",
						"as_oilrig",
						"cs_siege",
						"de_cbble",
						"de_dust",
						"cs_747",
						"de_prodigy",
						"cs_assault",
						"cs_office",
						"cs_italy",
						"cs_backalley",
						"cs_militia",
						"de_train",
					])
					->cannotBeEmpty()
				->end()
				->arrayNode('categories')
					->useAttributeAsKey('name')
					->prototype('array')
						->children()
							->scalarNode('name')
								->info('The timezone of the datetime values which are saved and will be saved in the database. If empty, the server timezone (see `date_default_timezone_get`) wil be choosen.')
								->defaultValue('')
								->cannotBeEmpty()
							->end()
							->scalarNode('regex')
								->info('The timezone of the datetime values which are saved and will be saved in the database. If empty, the server timezone (see `date_default_timezone_get`) wil be choosen.')
								->defaultValue('')
								->validate()
									->ifTrue(function ($_value) { return $this->regexIsNotParseable($_value); })
									->thenInvalid('Some directories do not exist or are not writable.')
								->end()
							->end()
						->end()
					->end()
				->end()
			->end();
        

        // @formatter:on

		return $treeBuilder;
	}

	/**
	 * Returns `true` if the submitted directory is *not* writable, else `false`.
	 *
	 * If the directory does not exists, the method tries to create the directory.
	 *
	 * @param string $path
	 *
	 * @return boolean
	 */
	protected function directoryIsNotReadable($path)
	{

		$absolute_path = realpath($path);

		// directory does not exists
		if( false === $absolute_path )
		{
			return true;
		}
		else
		{
			// return if submitted parameter exists, but is not a directory
			if( !is_dir($absolute_path) )
			{
				return true;
			}
		}

		if( !is_readable($absolute_path) )
		{
			return true;
		}

		return false;
	}

	/**
	 * Returns `true` if the submitted string is *not* a valid timezone, else `false`.
	 *
	 * @param string $regex
	 *
	 * @return boolean
	 */
	protected function regexIsNotParseable($regex)
	{
		return false;
	}
}