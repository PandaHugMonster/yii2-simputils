#!/bin/env php
<?php

use spaf\simputils\attributes\Property;
use spaf\simputils\PHP;
use spaf\simputils\yii\base\BaseObject;
use spaf\simputils\yii\components\InitConfig;
use function spaf\simputils\basic\now;
use function spaf\simputils\basic\pd;
use function spaf\simputils\basic\pr;

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/vendor/yiisoft/yii2/Yii.php';

$sut_config = PHP::init(new InitConfig());

$application = new spaf\simputils\yii\console\Application([
	'id' => 'bla',
]);


/**
 * Class MyClass
 * @property-read string $me
 */
class MyClass extends BaseObject {

	#[Property('me')]
	protected function tt(): string {
		return 'TEST';
	}

}


$obj = new MyClass();


pr($obj->me, PHP::type($sut_config), PHP::type(now()));
pd(PHP::getInitConfig()->working_dir);
