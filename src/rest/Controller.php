<?php

namespace spaf\simputils\yii\rest;

use spaf\simputils\traits\SimpleObjectTrait;
use spaf\simputils\yii\traits\ControllerExtensionTrait;

class Controller extends \yii\rest\Controller {
	use SimpleObjectTrait;
	use ControllerExtensionTrait;

}
