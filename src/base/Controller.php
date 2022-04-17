<?php

namespace spaf\simputils\yii\base;

use spaf\simputils\traits\SimpleObjectTrait;
use spaf\simputils\yii\traits\ControllerExtensionTrait;

class Controller extends \yii\base\Controller {
	use SimpleObjectTrait;
	use ControllerExtensionTrait;

}
