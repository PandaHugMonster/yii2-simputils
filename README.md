# yii2-simputils
Yii2 extension wrap for php-simputils, some useful wraps that improve usage

## Current condition
This version is initial wrapper-library for usage with Yii2 framework.

Basically it implements just an improvement of [VarDumper](https://www.yiiframework.com/doc/api/2.0/yii-helpers-vardumper) 
capabilities for "[pd()](https://github.com/PandaHugMonster/php-simputils/blob/a7f4f7cc71e23f95d124b7a768a4775995d9263d/src/spaf/simputils/basic.php#L25)" procedure. All other functionality will be added later.

### Recent changelog (0.1.1)

 *  Added `can()` method shortcut to check yii2 permissions
 *  Added additional functionality (controlling fields) to `spaf\yii\simputils\bootstrap\SimputilsBootstrap` and 
    `spaf\yii\simputils\helpers\PleaseDieVarDumper`


## Basic Usage
Install it through composer:
```shell
composer require spaf/yii2-simputils "*"
```

Add this to your yii2 config file for `console.php`:
```php
<?php
$config = [
//  ...
    'bootstrap' => [
	    [
	    	'class' => 'spaf\yii\simputils\bootstrap\SimputilsBootstrap',
		    'isConsole' => true,
	    ]
    ],
//  ...
];
```

And add this one for `web.php`:
```php
<?php
$config = [
//  ...
    'bootstrap' => [
	    [
	    	'class' => 'spaf\yii\simputils\bootstrap\SimputilsBootstrap',
	    ]
    ],
//  ...
];
```

And **that's it!** Now you can use the wrapped functionality (currently only `pd()` procedure).

In your code you can use now:

```php
<?php

use function spaf\simputils\basic\pd;

$myVar = [
    'key1' => 'value1',
    'key2' => [
        'subkey1' => 'subvalue1',
        'subkey2' => 12
    ],
];

pd($myVar);

```

**Important:** You need to use normal `pd()` procedure, this library does not redefine it, but adjust it's behaviour.