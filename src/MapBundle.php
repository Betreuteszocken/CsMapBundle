<?php

namespace MapBundle;

use Betreuteszocken\MapBundle\DependencyInjection\MapBundleExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class MapBundle
 *
 * @package MapBundle
 *
 */
class MapBundle extends Bundle
{

	public function getContainerExtension()
	{
		return new MapBundleExtension();
	}
}
