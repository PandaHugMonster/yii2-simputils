<?php

namespace spaf\simputils\yii\console;

use spaf\simputils\traits\SimpleObjectTrait;
use spaf\simputils\yii\traits\ApplicationExtensionTrait;

class Application extends \yii\console\Application {
	use SimpleObjectTrait;
	use ApplicationExtensionTrait;

	public function init() {
		if (!isset($this->controllerMap['help'])) {
			$this->controllerMap['help'] = 'spaf\simputils\yii\console\controllers\HelpController';
		}

		parent::init();
	}

}
