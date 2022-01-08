<?php

namespace spaf\simputils\yii\mutex;

use spaf\simputils\traits\SimpleObjectTrait;

abstract class DbMutex extends \yii\mutex\DbMutex {
	use SimpleObjectTrait;

}
