<?php

namespace spaf\simputils\yii\traits;

use spaf\simputils\PHP;
use spaf\simputils\yii\components\SelfSubAppInitConfig;
use function array_replace_recursive;
use function spaf\simputils\basic\path;

trait ApplicationExtensionTrait {

	public function __construct($config = []) {
		$sut_lib_config = PHP::getInitConfig(SelfSubAppInitConfig::SELF_NAME);

		$default_config = require path(
			$sut_lib_config->working_dir,
			'internal-configs',
			'default-config.php'
		);
		$config = array_replace_recursive($default_config, $config);
		parent::__construct($config);
	}

}
