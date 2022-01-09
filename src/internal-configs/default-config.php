<?php

use spaf\simputils\PHP;
use spaf\simputils\yii\components\SelfSubAppInitConfig;

$lib_working_dir = (PHP::getInitConfig(SelfSubAppInitConfig::SELF_NAME))->working_dir;

return [
	'id' => 'app',
	'basePath' => PHP::getInitConfig()->working_dir,
	'container' => [
		'definitions' => require __DIR__."/definitions.php",
	],
];
