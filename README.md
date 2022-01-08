# yii2-simputils
Yii2 extension wrap for [SimpUtils](https://github.com/PandaHugMonster/php-simputils).
Integrates natively SimpUtils stuff with Yii2 framework.

**Important:** In case if you want to use this integration - make sure you use classes from
this package, rather than from the initial SimpUtils classes. They suppose to have exactly
the same short-class-name as in SimpUtils (minus a few exceptions like `ExtendedObject` 
that represents mix of Yii2 and SimpUtils).
The same time, if there is no class/function declared in this extension package, 
use directly implementation of the SimpUtils.

_Short rule: If class/model/function with the same name exists in `yii2-simputils` use
it, otherwise use that class/model/function provided by `php-simputils`_

## Basic Usage
Install it through composer:
```shell
composer require spaf/yii2-simputils "*"
```

You need to make sure, you put `PHP::init(new InitConfig())` into the index-file
at `/web/index.php` (or any other entry-script) between the constants definition and the
Yii App object creation. This way you can be sure that all the low-level routines are
initialized before Yii2 app configuration.

**Important:** Yes, the SimpUtils and this extension represent low-level micro-framework,
that does it's **bootstrapping/initialization earlier** than anything Yii2 is done (including
Yii2 bootstrapping process). _Overall this will not compromise performance of requests!_

So the `/web/index.php` could look like that:

```php
<?php

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';


// This would be the best place to insert the PHP::init()
use spaf\simputils\PHP;
use spaf\yii\simputils\components\InitConfig;
PHP::init(new InitConfig());
////


$config = require __DIR__ . '/../config/web.php';

(new yii\web\Application($config))->run();
```


or as a one-liner:
```php
<?php

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';


// One-liner
spaf\simputils\PHP::init(new spaf\yii\simputils\components\InitConfig());
////


$config = require __DIR__ . '/../config/web.php';

(new yii\web\Application($config))->run();

```



# Some dev notes

 * `basePath` is fulfilled from `PHP::getInitConfig()->working_dir` if it's not set in the config.
   Code is in `ApplicationExtensionTrait`
 * The design of namespaces was done in a such way, that you can simply prefix Yii2 namespaces like
   `yii\base\Model` with `spaf\simputils\` - and get final extended functionality without 
   much of effort. Result should look like this: `spaf\simputils\yii\base\Model`.
 * Super awesome results of efficiency tests of properties usage (rough, subjective, but still)
   SimpUtils applied on top of Yii2 `Model` class, and created 10000 objects of it, with usage
   of mixed standard fields + "getter/setter" fields Averaged of 10 cycles (in total 100 000 cycles)
   > `Executed within: 0.243214 [Yii2 model with SimpUtils]`
   > 
   > `Executed within: 0.249595 [Yii2 model without SimpUtils]`
   
   Even though the numbers are ridiculously small anyway, and SimpUtils applied code seems to be
   even faster, you can consider almost 1:1 efficiency (+/- considered). But as mentioned earlier,
   The numbers are too small to even consider any problems, especially if you are ok to warp your
   project into docker containers - you should be fine in any possible tradeoffs :).
 * Prepare examples of usage `SimpUtils Yii2`
 * Wrap Version information?
