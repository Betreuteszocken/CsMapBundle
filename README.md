## CounterStrike Map Bundle

[![Release](https://img.shields.io/badge/Release-0.0.0-blue.svg?style=flat)](https://github.com/Betreuteszocken/CsMapBundle/releases/tag/0.0.0)
[![Packagist](https://img.shields.io/badge/Packagist-0.0.0-blue.svg?style=flat)](https://packagist.org/packages/betreuteszocken/cs-map-bundle)
[![LICENSE](https://img.shields.io/badge/License-MIT-blue.svg?style=flat)](LICENSE)
[![Symfony](https://img.shields.io/badge/Symfony-≥3-red.svg?style=flat)](https://symfony.com/)
[![Doctrine DBAL](https://img.shields.io/badge/Doctrine_DBAL-≥2.5-red.svg?style=flat)](https://github.com/doctrine/dbal)

TODO

### Table of Contents

* [Integration](#integration)
  * [Install via Composer](#install-via-composer)
  * [Add Bundle to Symfony Application](#add-bundle-to-symfony-application)
  * [Configure](#add-bundle-to-symfony-application)

### Integration

#### Install via Composer

```bash
composer require betreuteszocken/cs-map-bundle "dev-master"
```

#### Add Bundle to Symfony Application

##### Add the `Betreuteszocken\CsMapBundle` to `app/AppKernel.php`

```php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        return [
            // [...]
            new Betreuteszocken\CsMapBundle\CsMapBundle(),
        ];
    }
    
    // [...]
}
```

#### Configure

##### Add Configuration

Via the `config.yml`

```yaml
cs_maps:
    path: "/home/user/.steam/steam/steamapps/common/csgo/maps"
    categories:
        - {name: "aim_*",     regex: '^aim_'}
        - {name: "cs_*",      regex: '^cs_'}
        - {name: "de_*",      regex: '^de_'}
        - {name: "fy_*",      regex: '^fy_'}
```