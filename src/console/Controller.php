<?php

namespace spaf\simputils\yii\console;

use spaf\simputils\traits\SimpleObjectTrait;
use spaf\simputils\yii\traits\ControllerExtensionTrait;

class Controller extends \yii\console\Controller {
	use SimpleObjectTrait;
	use ControllerExtensionTrait;

}
