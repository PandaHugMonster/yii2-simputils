<?php

namespace spaf\simputils\yii\traits;

use spaf\simputils\PHP;

trait ApplicationExtensionTrait {

	public function __construct($config = []) {
		if (empty($config['basePath'])) {
			$config['basePath'] = PHP::getInitConfig()->working_dir;
		}
		parent::__construct($config);
	}

}
