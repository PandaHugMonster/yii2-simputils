#!/bin/env php
<?php

use spaf\simputils\attributes\DebugHide;
use spaf\simputils\attributes\Extract;
use spaf\simputils\attributes\Property;
use spaf\simputils\PHP;
use spaf\simputils\yii\base\BaseObject;
use spaf\simputils\yii\base\Model;
use spaf\simputils\yii\components\InitConfig;
use function spaf\simputils\basic\pd;

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
 * @property string $something
 * @property ?\spaf\simputils\yii\components\DateTime $dt
 */
class MyClass extends BaseObject {

	#[Property]
	public ?\spaf\simputils\yii\components\DateTime $_dt = null;

	public $gogo;

	#[Property('me')]
	protected function tt(): string {
		return 'TEST';
	}

	public function getSomething() {
		return 'str';
	}

	public function setSomething($var) {
		$this->gogo = $var;
	}
}


$obj = new MyClass();


//pr($obj->me, PHP::type($sut_config), PHP::type(now()));
//pd(PHP::getInitConfig()->working_dir);
//pd(isset($obj->something));
$obj->something = '333';
$obj->dt = '1234-05-05 01:02:03';

$model = new Model();

pd($obj, $model->toArray());
